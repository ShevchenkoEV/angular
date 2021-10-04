import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable, throwError} from "rxjs";
import {ResponseHttp} from "../models/responseHttp";
import {environment} from "../../environments/environment";
import {catchError, map} from "rxjs/operators";
import {Category} from "../models/category";

@Injectable({
    providedIn: 'root'
})
export class CategoryService {

    httpOptions = {
        headers: new HttpHeaders({
            'Access-Control-Allow-Origin':'*',
            'Access-Control-Allow-Headers':'Content-Type',
            'Access-Control-Allow-Methods':'GET, POST, DELETE, PUT, OPTIONS',
        })
    };

    constructor(private httpClient: HttpClient) {

    }

    getCategories(): Observable<Category[]> {
        return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/categories').pipe(
            map((data: ResponseHttp) => {
                return data.data.items;
            }),
            catchError((error) => {
                console.log("E_ERROR - ", error);
                return throwError(error);
            })
        )
    }

    createCategory(category: Category) {
        return this.httpClient.post<ResponseHttp>(environment.apiUrl + 'api/categories', category).pipe(
            map((date: ResponseHttp) => {
                return date.data.items;
            }),
            catchError((error) => {
                console.log("E_ERROR - ", error);
                return throwError(error);
            })
        )
    }

    findCategory(id: number): Observable<Category> {
        return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/categories/' + id)
            .pipe(map((data: ResponseHttp) => {
                    return data.data.item;
                }),
                catchError((error) => {
                    console.log("E_ERROR - ", error);
                    return throwError(error);
                })
            )
    }


    update(category: Category) {
        return this.httpClient.patch<ResponseHttp>(environment.apiUrl + 'api/categories/' + category.id, category, this.httpOptions)
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
        console.log("my log delete: ", id);
        return this.httpClient
            .delete<ResponseHttp>(environment.apiUrl + 'api/categories/' + id)
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
