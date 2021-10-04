import {Component, OnInit} from '@angular/core';
import {NavigationService} from "../../../services/navigation.service";
import {Navigation} from "../../../models/navigation";
import {NavigationEnd, Router} from "@angular/router";
import {AuthService} from "../../../services/auth/auth.service";
import {filter} from "rxjs/operators";

@Component({
    selector: 'app-layout',
    templateUrl: './layout.component.html',
    styleUrls: ['./layout.component.css']
})
export class LayoutComponent implements OnInit {

    navigation: Navigation[];
    hideItems: boolean = true;


    constructor(
        private navigationService: NavigationService,
        private router: Router,
        private authService: AuthService
    ) {
        this.router.events.pipe(
            filter((event: any) => event instanceof NavigationEnd)
        ).subscribe((url: any) => {
            if (url.url && this.authService.checkUser()){
                this.hideItems = false;
            }
            if (url.url && this.authService.checkUser() && !this.navigation && this.authService.isAdmin()) {
                this.getMenu();
            }
        })
    }

    ngOnInit(): void {
        // this.getMenu();
    }

    getMenu(): void {
        this.navigationService.getNavigation().subscribe(
            (data: Navigation[]) => {
                this.navigation = data;
            }
        );
    }

}
