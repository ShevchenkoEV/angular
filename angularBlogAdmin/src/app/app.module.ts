import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {LayoutComponent} from './components/layout/layout/layout.component';
import {NavigationComponent} from './components/layout/navigation/navigation.component';
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import { LoginComponent } from './components/login/login.component';
import { MainpageComponent } from './components/mainpage/mainpage.component';
import { DashboardComponent } from './components/admin/dashboard/dashboard.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {AuthinterceptorInterceptor} from "./interceptors/authinterceptor.interceptor";
import { ListPostsComponent } from './components/admin/posts/list-posts/list-posts.component';
import { EditPostComponent } from './components/admin/posts/edit-post/edit-post.component';
import { CreatePostComponent } from './components/admin/posts/create-post/create-post.component';
import { ListCategoriesComponent } from './components/admin/categories/list-categories/list-categories.component';
import { EditCategoryComponent } from './components/admin/categories/edit-category/edit-category.component';
import { CreateCategoryComponent } from './components/admin/categories/create-category/create-category.component';
import { CreateMenuComponent } from './components/admin/menus/create-menu/create-menu.component';
import { EditMenuComponent } from './components/admin/menus/edit-menu/edit-menu.component';
import { ListMenusComponent } from './components/admin/menus/list-menus/list-menus.component';
import { ListUsersComponent } from './components/admin/users/list-users/list-users.component';
import { CreateUserComponent } from './components/admin/users/create-user/create-user.component';
import { EditUserComponent } from './components/admin/users/edit-user/edit-user.component';
import { RegistrationComponent } from './components/registration/registration.component';

@NgModule({
    declarations: [
        AppComponent,
        LayoutComponent,
        NavigationComponent,
        LoginComponent,
        MainpageComponent,
        DashboardComponent,
        ListPostsComponent,
        EditPostComponent,
        CreatePostComponent,
        ListCategoriesComponent,
        EditCategoryComponent,
        CreateCategoryComponent,
        CreateMenuComponent,
        EditMenuComponent,
        ListMenusComponent,
        ListUsersComponent,
        CreateUserComponent,
        EditUserComponent,
        RegistrationComponent,
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        HttpClientModule,
        FormsModule,
        ReactiveFormsModule,
    ],
    providers: [
        {
            provide : HTTP_INTERCEPTORS,
            useClass: AuthinterceptorInterceptor,
            multi: true
        },


    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
