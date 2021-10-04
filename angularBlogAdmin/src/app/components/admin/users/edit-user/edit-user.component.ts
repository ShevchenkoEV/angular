import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {User} from "../../../../models/user";
import {UserService} from "../../../../services/user.service";
import {ActivatedRoute, Router} from "@angular/router";
import {catchError} from "rxjs/operators";
import {ResponseHttp} from "../../../../models/responseHttp";
import {throwError} from "rxjs";

@Component({
    selector: 'app-edit-user',
    templateUrl: './edit-user.component.html',
    styleUrls: ['./edit-user.component.css']
})
export class EditUserComponent implements OnInit {

    id: number;
    form: FormGroup;
    user: User;
    imageUpload: string;
    error: any
    urlPath: string = 'http://laravelapi.loc/uploads/';

    constructor(private userService: UserService,
                private router: Router,
                private route: ActivatedRoute) {
    }

    get f() {
        return this.form.controls;
    }

    ngOnInit(): void {
        this.findUser();
    }

    private findUser(): void {
        this.id = this.route.snapshot.params['userId'];
        this.userService.findUser(this.id).subscribe(
            (data: User) => {
                this.user = data;
                this.form = new FormGroup({
                    name: new FormControl(data.name, Validators.required),
                    email: new FormControl(data.email, Validators.required),
                    password: new FormControl('', Validators.required),
                    avatar: new FormControl(data.avatar, Validators.required)
                })
            }
        )
    }

    onImageSelect($event: Event) {
        const file = (event.target as HTMLInputElement).files[0];
        const allowedMineTypes = ["image/png", "image/jpeg", "image/jpg"];
        if (file && allowedMineTypes.includes(file.type)) {
            const reader = new FileReader();
            reader.onload = () => {
                this.imageUpload = reader.result as string;
                this.form.patchValue({
                    avatar: reader.result
                })
            }
            reader.readAsDataURL(file);
        }
    }

    onSubmit() {
        this.user.name = this.f.name.value;
        this.user.email = this.f.email.value;
        this.user.password = this.f.password.value;
        this.user.avatar = this.f.avatar.value;
        this.userService.update(this.user)
            .pipe(catchError((error: any) => {
                this.error = (error.error as ResponseHttp).errors.message
                return throwError(error);
            }))
            .subscribe((data) => {
                if (data) {
                    this.router.navigateByUrl('admin/users');
                }
            });
    }
}
