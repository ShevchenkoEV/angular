import {Component, OnInit} from '@angular/core';
import {PostsService} from "../../services/posts.service";
import {Post} from "../../models/post";
import {environment} from "../../../environments/environment";

@Component({
    selector: 'app-mainpage',
    templateUrl: './mainpage.component.html',
    styleUrls: ['./mainpage.component.css']
})
export class MainpageComponent implements OnInit {

    posts: Post[];
    urlPath: string = 'http://laravelapi.loc/uploads/';

    constructor(private postService: PostsService) {
    }

    ngOnInit(): void {
        this.getPosts();
    }

    private getPosts() {
        this.postService.getPosts().subscribe(
            (data: Post[]) => {
                this.posts = data;
                console.log(this.posts);
            }
        );
    }
}
