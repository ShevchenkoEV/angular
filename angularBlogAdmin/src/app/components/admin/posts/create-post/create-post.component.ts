import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {PostsService} from "../../../../services/posts.service";
import {CategoryService} from "../../../../services/category.service";
import {Router} from "@angular/router";
import {Post} from "../../../../models/post";
import {Category} from "../../../../models/category";
import {catchError} from "rxjs/operators";
import {throwError} from "rxjs";
import {ResponseHttp} from "../../../../models/responseHttp";

@Component({
  selector: 'app-create-post',
  templateUrl: './create-post.component.html',
  styleUrls: ['./create-post.component.css']
})
export class CreatePostComponent implements OnInit {

  form: FormGroup;
  imageUpload: string;
  post: Post;
  categories: Category[];
  error: any;

  constructor(private postService: PostsService,
              private categoryService: CategoryService,
              private router: Router) { }

  ngOnInit(): void {
    this.getCategoryForPost();
    this.setForm();
  }

  get f() {
    return this.form.controls;
  }

  private setForm() {
    this.form = new FormGroup({
      title: new FormControl('', Validators.required),
      content: new FormControl('', Validators.required),
      image: new FormControl('', Validators.required),
      category_id: new FormControl('', Validators.required)
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
          image: reader.result
        })
      }
      reader.readAsDataURL(file);
    }
  }

  getCategoryForPost() {
    this.categoryService.getCategories().subscribe((data: Category[]) => {this.categories = data} )

  }

  onSubmit() {
    this.postService.createPost(this.form.value)
        .pipe(catchError((error: any) => {
          this.error = (error.error as ResponseHttp).errors.message
          return throwError(error);
        }))
        .subscribe((data) => {
          if (data) {
            this.router.navigateByUrl('admin/posts');
          }
        });
  }
}
