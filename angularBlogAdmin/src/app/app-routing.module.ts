import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from "./components/login/login.component";
import { MainpageComponent } from "./components/mainpage/mainpage.component";
import { DashboardComponent } from "./components/admin/dashboard/dashboard.component";
import { AuthGuard } from "./guards/auth.guard";
import { ListPostsComponent } from "./components/admin/posts/list-posts/list-posts.component";
import { ListUsersComponent } from "./components/admin/users/list-users/list-users.component";
import { ListCategoriesComponent } from "./components/admin/categories/list-categories/list-categories.component";
import { ListMenusComponent } from "./components/admin/menus/list-menus/list-menus.component";
import { CreateCategoryComponent } from "./components/admin/categories/create-category/create-category.component";
import { EditCategoryComponent } from "./components/admin/categories/edit-category/edit-category.component";
import { CreateUserComponent } from "./components/admin/users/create-user/create-user.component";
import { EditUserComponent } from "./components/admin/users/edit-user/edit-user.component";
import { CreatePostComponent } from "./components/admin/posts/create-post/create-post.component";
import { EditPostComponent } from "./components/admin/posts/edit-post/edit-post.component";
import { CreateMenuComponent } from "./components/admin/menus/create-menu/create-menu.component";
import { EditMenuComponent } from "./components/admin/menus/edit-menu/edit-menu.component";
import { RegistrationComponent } from './components/registration/registration.component';

const routes: Routes = [
    { path: '', component: MainpageComponent },
    { path: 'login', component: LoginComponent },
    { path: 'registration', component: RegistrationComponent },

    { path: 'admin', component: DashboardComponent, pathMatch: 'full', canActivate: [AuthGuard] },

    { path: 'admin/users', component: ListUsersComponent, canActivate: [AuthGuard] },
    { path: 'admin/users/create', component: CreateUserComponent, canActivate: [AuthGuard] },
    { path: 'admin/users/:userId/edit', component: EditUserComponent, canActivate: [AuthGuard] },

    { path: 'admin/posts', component: ListPostsComponent, canActivate: [AuthGuard] },
    { path: 'admin/posts/create', component: CreatePostComponent, canActivate: [AuthGuard] },
    { path: 'admin/posts/:postId/edit', component: EditPostComponent, canActivate: [AuthGuard] },

    { path: 'admin/categories', component: ListCategoriesComponent, canActivate: [AuthGuard] },
    { path: 'admin/categories/create', component: CreateCategoryComponent, canActivate: [AuthGuard] },
    { path: 'admin/categories/:categoryId/edit', component: EditCategoryComponent, canActivate: [AuthGuard] },

    { path: 'admin/menus', component: ListMenusComponent, canActivate: [AuthGuard] },
    { path: 'admin/menus/create', component: CreateMenuComponent, canActivate: [AuthGuard] },
    { path: 'admin/menus/:menuId/edit', component: EditMenuComponent, canActivate: [AuthGuard] },

    { path: '**', redirectTo: '', pathMatch: 'full' }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
