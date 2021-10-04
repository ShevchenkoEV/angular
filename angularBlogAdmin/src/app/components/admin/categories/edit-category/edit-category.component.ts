import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from "@angular/router";
import { CategoryService } from "../../../../services/category.service";
import { Category } from "../../../../models/category";
import { FormControl, FormGroup, Validators } from "@angular/forms";

@Component({
    selector: 'app-edit-category',
    templateUrl: './edit-category.component.html',
    styleUrls: ['./edit-category.component.css']
})
export class EditCategoryComponent implements OnInit {

    id: number;
    category: Category;
    form: FormGroup;
    error: any;

    constructor(
        private router: Router,
        private route: ActivatedRoute,
        private categoryService: CategoryService,
    ) { }

    get f() {
        return this.form.controls;
    }

    ngOnInit(): void {
        this.findCategory();
        // console.log("FIND CATEGORY 2: ", this.category);
    }

    findCategory(): void {
        this.id = this.route.snapshot.params['categoryId']
        this.categoryService.findCategory(this.id).subscribe(
            (data: Category) => {
                this.category = data;
                this.form = new FormGroup({
                    title: new FormControl(data.title, Validators.required)
                })

                // console.log("FIND CATEGORY: ", this.category);
                // console.log("FIND form: ", this.form);
            }
        );
    }

    onSubmit(): void {


        this.category.title = this.f.title.value;
        console.log("my log: ", this.category);
        this.categoryService.update(this.category).subscribe(
            () => {
                this.router.navigateByUrl('admin/categories');

            }
        )
    }
}
