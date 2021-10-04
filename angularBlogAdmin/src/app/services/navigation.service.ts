import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable, throwError} from "rxjs";
import {Navigation} from "../models/navigation";
import {environment} from "../../environments/environment";
import {catchError, map} from "rxjs/operators";
import {ResponseHttp} from "../models/responseHttp";

@Injectable({
  providedIn: 'root'
})
export class NavigationService {

  constructor(private http: HttpClient) { }

  getNavigation(): Observable<Navigation[]>{
    return this.http.get<ResponseHttp>(environment.apiUrl + 'api/adminMenus').pipe(
        map((data) => {
          return data.data.items;
          console.log("my log: ", data.data.items)
        }),
        catchError((error) => {
          console.log("ERROR - ", error);
          return throwError(error);
        })
    )
  }
}
