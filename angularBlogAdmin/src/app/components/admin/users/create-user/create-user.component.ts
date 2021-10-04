import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from "@angular/forms";
import { User } from "../../../../models/user";
import {UserService} from "../../../../services/user.service";
import {catchError} from "rxjs/operators";
import {ResponseHttp} from "../../../../models/responseHttp";
import {throwError} from "rxjs";
import {Router} from "@angular/router";

@Component({
    selector: 'app-create-user',
    templateUrl: './create-user.component.html',
    styleUrls: ['./create-user.component.css']
})
export class CreateUserComponent implements OnInit {

    form: FormGroup;
    user: User;
    imageUpload: string;
    error: any;

    constructor(private userService: UserService,
                private router: Router) {}

    ngOnInit(): void {
        this.setForm();
    }
    get f() {
        return this.form.controls;
    }

    setForm() {
        this.form = new FormGroup({
            name: new FormControl('', Validators.required),
            email: new FormControl('', Validators.required),
            password: new FormControl('', Validators.required),
            password_confirmation: new FormControl('', Validators.required),
            avatar: new FormControl(null)
        })
    }

    onImageSelect(event: Event) {
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
        this.userService.createUser(this.form.value)
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