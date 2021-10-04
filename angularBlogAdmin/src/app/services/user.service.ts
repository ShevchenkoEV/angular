import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable, throwError} from "rxjs";
import {ResponseHttp} from "../models/responseHttp";
import {environment} from "../../environments/environment";
import {catchError, map} from "rxjs/operators";
import {User} from "../models/user";

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private httpClient: HttpClient) { }

  getUsers(): Observable<User[]> {
    return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/users').pipe(
        map((data: ResponseHttp) => {
          return data.data.items;
        }),
        catchError((error) => {
          console.log("E_ERROR - ", error);
          return throwError(error);
        })
    )
  }

  createUser(user: User) {
    return this.httpClient.post<ResponseHttp>(environment.apiUrl + 'api/users', user)
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

  findUser(id: number): Observable<User> {
    return this.httpClient.get<ResponseHttp>(environment.apiUrl + 'api/users/' + id)
        .pipe(map((data: ResponseHttp) => {
              return data.data.item;
            }),
            catchError((error) => {
              console.log("E_ERROR - ", error);
              return throwError(error);
            })
        )
  }


  update(user: User) {
      console.log("My log UPDATE: ", user);
    return this.httpClient.put<ResponseHttp>(environment.apiUrl + 'api/users/' + user.id, user)
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
        .delete<ResponseHttp>(environment.apiUrl + 'api/users/' + id)
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
