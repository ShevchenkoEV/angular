import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable, throwError} from "rxjs";
import {ResponseHttp} from "../models/responseHttp";
import {environment} from "../../environments/environment";
import {catchError, map} from "rxjs/operators";
import {Menu} from "../models/menu";

@Injectable({
  providedIn: 'root'
})
export class MenuService {

  constructor(private httpClient: HttpClient) { }

  getMenus(): Observable<Menu[]> {
    return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/menus').pipe(
        map((data: ResponseHttp) => {
          return data.data.items;
        }),
        catchError((error) => {
          console.log("E_ERROR - ", error);
          return throwError(error);
        })
    )
  }

  createMenu(menu: Menu) {
    return this.httpClient.post<ResponseHttp>(environment.apiUrl + 'api/menus', menu).pipe(
        map((date: ResponseHttp) => {
          return date.data.items;
        }),
        catchError((error) => {
          console.log("E_ERROR - ", error);
          return throwError(error);
        })
    )
  }

  findMenu(id: number): Observable<Menu> {
    return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/menus/' + id)
        .pipe(map((data: ResponseHttp) => {
              return data.data.item;
            }),
            catchError((error) => {
              console.log("E_ERROR - ", error);
              return throwError(error);
            })
        )
  }


  update(menu: Menu) {
    return this.httpClient.patch<ResponseHttp>(environment.apiUrl + 'api/menus/' + menu.id, menu)
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
        .delete<ResponseHttp>(environment.apiUrl + 'api/menus/' + id)
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
