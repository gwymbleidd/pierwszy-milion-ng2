import { Injectable, Component } from '@angular/core';
import { Component, ViewContainerRef } from '@angular/core';
import { Location } from '@angular/common'
import { ICredentials } from './credentials';
import { Response, Headers, RequestOptions, Http } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import { InterceptorService } from 'ng2-interceptors';
import { GlobalStateService } from './../globalstate.service';
import { 
  ROUTER_DIRECTIVES, 
  RouteConfig, 
  ROUTER_PROVIDERS, 
  Router 
} from '@angular/router';

@Injectable()
export class LoginService {
	private loginUrl = '/oauth/v2/token';

	constructor (private _globalState: GlobalStateService, 
				private _location: Location, 
				private _http: InterceptorService,
            	private _router: Router) {
	}

	hanldeError(err) {
      	var res = JSON.parse(err._body); 
      	console.log("Nieprawidłowy login lub hasło")
      	console.log(res.error_description)
		this._globalState.logout();
	}

	handleSuccess(data) {
		this._globalState.state.credentials.access_token = data.access_token;
		this._globalState.state.credentials.refresh_token = data.access_token;
		this._globalState.login();
        this._location.replaceState('/');
        this._router.navigate(['dashboard/home']);
	}

	login(credentials: ICredentials) {
	  var headers = new Headers();
	  headers.append('Content-Type', 'application/x-www-form-urlencoded');
	  var body = 'username=' + credentials.username 
			  + '&password=' + credentials.password
			  +	'&client_id=1_1f89qgisf6pwo8cc4s40sogcw0csk4oogsk0w08gkgcwg4s8ks'
			  + '&client_secret=64qgef5al1gksosg4og80w0w0wkcscsogs44sgcokk0sc08kc4'
			  + '&grant_type=password';

	  this._http.post(this.loginUrl, body, {
	    headers: headers
	    })
	    .map(res => res.json())
	    .subscribe(
	      data => this.handleSuccess(data),
	      err => this.hanldeError(err)
	    );
	}
}