import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {CategoryService} from "../../../../services/category.service";
import {catchError} from "rxjs/operators";
import {throwError} from "rxjs";
import {ResponseHttp} from "../../../../models/responseHttp";
import {Category} from "../../../../models/category";

@Component({
    selector: 'app-create-category',
    templateUrl: './create-category.component.html',
    styleUrls: ['./create-category.component.css']
})
export class CreateCategoryComponent implements OnInit {

    category: Category;
    createForm: FormGroup;
    public error: string = "";

    constructor(
        private formBuilder: FormBuilder,
        private categoryService: CategoryService,
        private router: Router,
    ) {
    }

    get f() {
        return this.createForm.controls;
    }

    ngOnInit(): void {
        this.setCreateForm()
    }

    private setCreateForm(): void {
        this.createForm = this.formBuilder.group({
            title: ['', Validators.required],
        })
    }

    onSubmit() {
        this.categoryService.createCategory(this.createForm.value)
            .pipe(catchError((error: any) => {
                this.error = (error.error as ResponseHttp).errors.message
                return throwError(error);
            }))
            .subscribe((data) => {
                if (data) {
                    this.router.navigateByUrl('admin/categories');
                }
            });

        console.log("error", this.error)
    }
}
