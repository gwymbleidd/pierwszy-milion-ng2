import { Injectable } from '@angular/core'

@Injectable()
export class GlobalStateService {
	config = {
		baseUrl: 'http://api.pierwszy-milion.dev'
	}

	state = {
		loggedIn: false,
		credentials: {}
	}

	login() {
		this.state.loggedIn = true;
	}
	logout() {
		this.state.loggedIn = false;
	}
}