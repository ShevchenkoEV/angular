import {Component, Input, OnInit} from '@angular/core';
import {Navigation} from "../../../models/navigation";

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.css']
})
export class NavigationComponent implements OnInit {

  @Input() navigation: Navigation[];
  @Input() hideItems: boolean;


  constructor() {}

  ngOnInit(): void {
  }

}
