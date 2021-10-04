import {Injectable} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {ResponseHttpLogin} from "../../models/responseHttpLogin";
import {environment} from "../../../environments/environment";
import {catchError, map} from "rxjs/operators";
import {throwError} from "rxjs";
import {User} from "../../models/user";
import {ResponseHttpRegisration} from "../../models/responseHttpRegistration";

@Injectable({
    providedIn: 'root'
})
export class AuthService {


    constructor(private http: HttpClient) {
    }

    checkUser(): boolean {
        if (sessionStorage.getItem('currentUser') && sessionStorage.getItem('userToken')) {
            return true;
        }
        return false;
    }

    logout(): void {
            sessionStorage.removeItem('currentUser');
            sessionStorage.removeItem('userToken');
    }

    login(email: string, password: string) {
        return  this.http.post<ResponseHttpLogin>(environment.apiUrl + 'api/login', {
            email, password
        }).pipe(
            map((data) => {
                if (data.data.user && data.data.api_token) {
                    this.setUser(JSON.stringify(data.data.user));
                    this.setToken(data.data.api_token);

                    return data.data.user;
                }
                return null;
            }),
            catchError((error) => {
                console.log("ERROR - ", error);
                return throwError(error);
            })
        )

    }

    registration(user: User) {
        return this.http.post<ResponseHttpRegisration>(environment.apiUrl + 'api/registration', user)
            .pipe(
                map((data) => {
                    if (data.data.user && data.data.api_token) {
                        this.setUser(JSON.stringify(data.data.user));
                        this.setToken(data.data.api_token);

                        return data.data.user;
                    }
                    return null;
                }),
                catchError((error) => {
                    console.log("ERROR - ", error);
                    return throwError(error);
                })
            )
    }

    setUser(user: string): void {
        sessionStorage.setItem('currentUser', user);
    }

    setToken(api_token: string): void {
        sessionStorage.setItem('userToken', api_token);
    }

    getToken(): string {
        if (this.checkUser()) {
            return sessionStorage.getItem('userToken');
        }
        return '';
    }

    isAdmin(): boolean {
        if (JSON.parse(sessionStorage.getItem('currentUser')).is_admin == 1){
            return true;
        }
       return false;

    }

}
