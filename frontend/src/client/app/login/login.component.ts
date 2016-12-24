import { Component } from '@angular/core';
import { LoginService } from './login.service'
import { ICredentials } from './credentials'
import { GlobalStateService } from './../globalstate.service';

@Component({
	moduleId: module.id,
	selector: 'login-cmp',
	templateUrl: 'login.component.html',
	providers: [LoginService]
})

export class LoginComponent { 
	private credentials: ICredentials = {
		access_token: '',
		role: '',
		username: '',
		password: ''
	}

	constructor(private _loginService: LoginService, private _globalState: GlobalStateService) {
	}

	login() {
		this._loginService.login(this.credentials);
	}
}
