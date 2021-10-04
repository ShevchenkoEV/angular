import { Component, OnInit } from '@angular/core';
import {Post} from "../../../../models/post";
import {PostsService} from "../../../../services/posts.service";

@Component({
  selector: 'app-list-posts',
  templateUrl: './list-posts.component.html',
  styleUrls: ['./list-posts.component.css']
})
export class ListPostsComponent implements OnInit {

  posts: Post[];
  urlPath: string = 'http://laravelapi.loc/uploads/';

  constructor(private postService: PostsService) { }

  ngOnInit(): void {
    this.getPosts();
  }

  private getPosts() {
    this.postService.getPosts().subscribe(
        (data: Post[]) => {
          this.posts = data;
        }
    )
  }

  deletePost(id: number) {
    console.log("DELETE ID: ", id);
    this.postService.delete(id).subscribe(() => {
      this.posts = this.posts.filter(user => user.id !== id);
    })
  }
}
