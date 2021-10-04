import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {AuthService} from "../../services/auth/auth.service";
import {ActivatedRoute, Router} from "@angular/router";
import {catchError} from "rxjs/operators";
import {throwError} from "rxjs";
import {ResponseHttpLogin} from "../../models/responseHttpLogin";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

    public loginForm: FormGroup;
    public submitted: boolean = false;
    public returnUrl: string = "admin";
    public error: string = "";

    constructor(
        private formBuilder: FormBuilder,
        private authService: AuthService,
        private router: Router,
        private route: ActivatedRoute
    ) {
    }

    get f() {
        return this.loginForm.controls;
    }

    ngOnInit(): void {
        this.userLogout();  //?
        this.setLoginForm();
    }


    private setLoginForm(): void {
        this.loginForm = this.formBuilder.group({
            email: ['', Validators.required],
            password: ['', Validators.required]
        })
    }

    private userLogout(): void {
        this.authService.logout()
    }

    onSubmit(): boolean {

        this.submitted = true;

        if (this.loginForm.invalid) {
            return false;
        }
        this.authService.login(this.f.email.value, this.f.password.value)
            .pipe(catchError((error: any) => {
                this.error = (error.error as ResponseHttpLogin).errors.message
                return throwError(error);
            }))
            .subscribe((data) => {
                if (data) {
                    this.router.navigate(this.redirectTo())
                }
            });
        return true;
    }

    private redirectTo(): any {
        if (this.authService.isAdmin()) {
            if (this.route.snapshot.paramMap.get('returnUrl')) {
                return this.route.snapshot.paramMap.get('returnUrl');
            }
            return [this.returnUrl];
        }
        return ['/']
    }
}
