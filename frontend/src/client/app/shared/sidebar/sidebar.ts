import { Component } from '@angular/core';
import { GlobalStateService } from './../../globalstate.service'

@Component({
	moduleId: module.id,
	selector: 'sidebar-cmp',
	templateUrl: 'sidebar.html'
})

export class SidebarComponent {
	isActive = false;
	showMenu: string = '';
	credentials: {}
	constructor (private _globalState: GlobalStateService) {
		console.log(_globalState.state)
		this.credentials = _globalState.state.credentials
	}

	eventCalled() {
		this.isActive = !this.isActive;
	}
	addExpandClass(element: any) {
		if (element === this.showMenu) {
			this.showMenu = '0';
		} else {
			this.showMenu = element;
		}
	}
}
