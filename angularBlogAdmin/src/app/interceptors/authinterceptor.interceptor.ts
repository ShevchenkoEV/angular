import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor
} from '@angular/common/http';
import { Observable } from 'rxjs';
import {AuthService} from "../services/auth/auth.service";

@Injectable()
export class AuthinterceptorInterceptor implements HttpInterceptor {

  constructor(private authservice: AuthService) {}

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {

    if (this.authservice.checkUser()){
      request = request.clone({
        setHeaders: {
          Authorization: 'Bearer ' + this.authservice.getToken()
        }
      });
    }
    return next.handle(request);
  }
}
