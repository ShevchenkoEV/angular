import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {MenuService} from "../../../../services/menu.service";
import {Router} from "@angular/router";
import {Menu} from "../../../../models/menu";
import {catchError} from "rxjs/operators";
import {ResponseHttp} from "../../../../models/responseHttp";
import {throwError} from "rxjs";

@Component({
  selector: 'app-create-menu',
  templateUrl: './create-menu.component.html',
  styleUrls: ['./create-menu.component.css']
})
export class CreateMenuComponent implements OnInit {

  menu: Menu;
  createForm: FormGroup;
  public error: string = "";


  constructor(
      private formBuilder: FormBuilder,
      private menuService: MenuService,
      private router: Router
  ) { }

  get f() {
    return this.createForm.controls;
  }

  ngOnInit(): void {
    this.setCreateForm()
  }

  private setCreateForm(): void {
    this.createForm = this.formBuilder.group({
      title: ['', Validators.required],
      path: ['', Validators.required],
      path_api: ['', Validators.required],
      type: ['', Validators.required],
      sort_order: ['', Validators.required],
    })
  }

  onSubmit() {
    this.menuService.createMenu(this.createForm.value)
        .pipe(catchError((error: any) => {
          this.error = (error.error as ResponseHttp).errors.message
          return throwError(error);
        }))
        .subscribe((data) => {
          if (data) {
            this.router.navigateByUrl('admin/menus');
          }
        });

    console.log("err", this.error);
  }


}
