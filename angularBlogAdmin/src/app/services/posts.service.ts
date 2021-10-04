import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable, throwError } from "rxjs";
import { Post } from "../models/post";
import { ResponseHttp } from "../models/responseHttp";
import { environment } from "../../environments/environment";
import { catchError, map } from "rxjs/operators";

@Injectable({
    providedIn: 'root'
})
export class PostsService {

    constructor(private httpClient: HttpClient) { }

    getPosts(): Observable<Post[]> {
        return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/home').pipe(
            map((data) => {
                return data.data.items;
            }),
            catchError((error) => {
                console.log("E_ERROR - ", error);
                return throwError(error);
            })
        )
    }

    createPost(post: Post) {
        return this.httpClient.post<ResponseHttp>(environment.apiUrl + 'api/posts', post)
            .pipe(
                map((date: ResponseHttp) => {
                    return date.data.items;
                }),
                catchError((error) => {
                    console.log("E_ERROR - ", error);
                    return throwError(error);
                })
            )
    }

    findPost(id: number): Observable<Post> {
        return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/posts/' + id)
            .pipe(map((data: ResponseHttp) => {
                return data.data.item;
            }),
                catchError((error) => {
                    console.log("E_ERROR - ", error);
                    return throwError(error);
                })
            )
    }

    update(post: Post) {
        console.log("My log SEND UPDATE: ", post);
        return this.httpClient.put<ResponseHttp>(environment.apiUrl + 'api/posts/' + post.id, post)
            .pipe(map((data: ResponseHttp) => {
                return data.data.item;
            }),
                catchError((error) => {
                    console.log("E_ERROR - ", error);
                    return throwError(error);
                })
            )
    }

    delete(id: number) {
        return this.httpClient
            .delete<ResponseHttp>(environment.apiUrl + 'api/posts/' + id)
            .pipe(map((data: ResponseHttp) => {
                return data.data.item;
            }),
                catchError((error) => {
                    console.log("E_ERROR - ", error);
                    return throwError(error);
                })
            )
    }

}
