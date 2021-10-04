import { Component, OnInit } from '@angular/core';
import {MenuService} from "../../../../services/menu.service";
import {Menu} from "../../../../models/menu";

@Component({
  selector: 'app-list-menus',
  templateUrl: './list-menus.component.html',
  styleUrls: ['./list-menus.component.css']
})
export class ListMenusComponent implements OnInit {

  menus: Menu[];

  constructor(private menuService: MenuService) { }

  ngOnInit(): void {
    this.getAllMenus();
  }

  private getAllMenus() {
    this.menuService.getMenus()
        .subscribe((data: Menu[]) => {
          this.menus = data;
        })
  }

  deleteMenu(id:number) {
    this.menuService.delete(id)
        .subscribe(() => {
          this.menus = this.menus.filter(menu => menu.id !== id)
        })
  }
}
