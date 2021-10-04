import {Component, OnInit} from '@angular/core';
import {CategoryService} from "../../../../services/category.service";
import {Category} from "../../../../models/category";

@Component({
    selector: 'app-list-categories',
    templateUrl: './list-categories.component.html',
    styleUrls: ['./list-categories.component.css']
})
export class ListCategoriesComponent implements OnInit {

    categories: Category[];

    constructor(private categoryService: CategoryService) {}

    ngOnInit(): void {
        this.getAllCategories();
    }

    private getAllCategories() {
        this.categoryService.getCategories().subscribe(
            (data: Category[]) => {
                this.categories = data;
                console.log(this.categories);
            }
        )
    }

    deleteCategory(id: number) {
        this.categoryService.delete(id)
            .subscribe(() => {
                this.categories = this.categories.filter(category => category.id !== id)
            })
    }


}
