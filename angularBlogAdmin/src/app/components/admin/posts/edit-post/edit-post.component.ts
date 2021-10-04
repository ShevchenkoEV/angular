import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from "@angular/forms";
import { Post } from "../../../../models/post";
import { ActivatedRoute, Router } from "@angular/router";
import { PostsService } from "../../../../services/posts.service";
import { Category } from "../../../../models/category";
import { CategoryService } from "../../../../services/category.service";
import { ResponseHttp } from 'src/app/models/responseHttp';
import { catchError } from 'rxjs/operators';
import { throwError } from 'rxjs';

@Component({
  selector: 'app-edit-post',
  templateUrl: './edit-post.component.html',
  styleUrls: ['./edit-post.component.css']
})
export class EditPostComponent implements OnInit {

  dataDownload: boolean = false;
  post: Post;
  form: FormGroup;
  error: any;
  urlPath: string = 'http://laravelapi.loc/uploads/';
  imageUpload: string;
  id: number;
  categories: Category[]


  constructor(
    private formBuilder: FormBuilder,
    private postService: PostsService,
    private categoryService: CategoryService,
    private router: Router,
    private route: ActivatedRoute,
  ) { }

  ngOnInit(): void {

    this.id = this.route.snapshot.params['postId'];

    this.postService.findPost(this.id).subscribe(
      (data: Post) => {
        this.post = data;
        console.log("LOG GET POST:", this.post);
        this.form.patchValue(data);
      }
    )

    this.categoryService.getCategories().subscribe(
      (data: Category[]) => {
        this.categories = data;
        console.log("LOG GET CATEGORIES:", this.categories);
      }
    )

    this.form = this.formBuilder.group({
      title: ['', Validators.required],
      content: ['', Validators.required],
      image: ['', Validators.required],
      category_id: ['', Validators.required],
    })

    this.dataDownload = true;

  }

  get f() {
    return this.form.controls;
  }

  onImage($event: any) {
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

  onSubmit() {

    this.post.title = this.f.title.value;
    this.post.content = this.f.content.value;
    this.post.image = this.f.image.value;
    this.post.category_id = this.f.category_id.value;
    this.postService.update(this.post)
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
