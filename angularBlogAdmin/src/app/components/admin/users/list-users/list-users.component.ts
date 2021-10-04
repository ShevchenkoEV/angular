import { Component, OnInit } from '@angular/core';
import {User} from "../../../../models/user";
import {UserService} from "../../../../services/user.service";

@Component({
  selector: 'app-list-users',
  templateUrl: './list-users.component.html',
  styleUrls: ['./list-users.component.css']
})
export class ListUsersComponent implements OnInit {

  users: User[];
  urlPath: string = 'http://laravelapi.loc/uploads/';

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.getAllUsers();
  }

  private getAllUsers() {
    this.userService.getUsers().subscribe(
        (data: User[]) => {
          this.users = data;
        }
    )
  }

  deleteUser(id: number) {
    this.userService.delete(id)
        .subscribe(() => {
          this.users = this.users.filter(user => user.id !== id)
        })
  }
}
