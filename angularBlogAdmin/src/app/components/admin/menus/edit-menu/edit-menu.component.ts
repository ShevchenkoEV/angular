import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {MenuService} from "../../../../services/menu.service";
import {Menu} from "../../../../models/menu";
import {FormControl, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-edit-menu',
  templateUrl: './edit-menu.component.html',
  styleUrls: ['./edit-menu.component.css']
})
export class EditMenuComponent implements OnInit {

  id: number;
  menu: Menu;
  form: FormGroup;
  error: any;

  constructor(
      private router: Router,
      private route: ActivatedRoute,
      private menuService: MenuService
  ) { }

  get f() {
    return this.form.controls;
  }

  ngOnInit(): void {
    this.findMenu();
  }


  findMenu(): void {
    this.id = this.route.snapshot.params['menuId']
    this.menuService.findMenu(this.id).subscribe(
        (data: Menu) => {
          this.menu = data;
          this.form = new FormGroup({
            title: new FormControl(data.title, Validators.required),
            path: new FormControl(data.path, Validators.required),
            path_api: new FormControl(data.path_api, Validators.required),
            type: new FormControl(data.type, Validators.required),
            sort_order: new FormControl(data.sort_order, Validators.required)
          })
        }
    );
  }

  onSubmit(): void {

    this.menu.title = this.f.title.value;
    this.menu.path = this.f.path.value;
    this.menu.path_api = this.f.path_api.value;
    this.menu.type = this.f.type.value;
    this.menu.sort_order = this.f.sort_order.value;
    this.menuService.update(this.menu).subscribe(
        () => {
          this.router.navigateByUrl('admin/menus');

        }
    )
  }
}
