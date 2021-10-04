import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {AuthService} from "../../services/auth/auth.service";
import {ActivatedRoute, Router} from "@angular/router";
import {catchError} from "rxjs/operators";
import {ResponseHttpRegisration} from "../../models/responseHttpRegistration";
import {throwError} from "rxjs";
import {User} from "../../models/user";

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.css']
})
export class RegistrationComponent implements OnInit {

  registrationForm: FormGroup;
  public submitted: boolean = false;
  public returnUrl: string = "admin";
  public error: string = "";
  user: User;

  constructor(private authService: AuthService,
              private formBuilder: FormBuilder,
              private router: Router,
              private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.userLogout();
    this.setForm();
  }

  get f() {
    return this.registrationForm.controls;
  }

  setForm():void {
    this.registrationForm = this.formBuilder.group({
      name: ['', Validators.required],
      email: ['', Validators.required],
      password: ['', Validators.required],
      password_confirmation: ['', Validators.required],
    })
  }
  private userLogout(): void {
    this.authService.logout()
  }

  onSubmit() {

    console.log("REGISTER VALUE: ", this.registrationForm.value);

    this.submitted = true;

    if (this.registrationForm.invalid) {
      return false;
    }
    this.user = this.registrationForm.value;
    this.authService.registration(this.user)
        .pipe(catchError((error: any) => {
          this.error = (error.error as ResponseHttpRegisration).errors.message
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
