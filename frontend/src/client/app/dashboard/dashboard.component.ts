import { Component } from '@angular/core';
import { InterceptorService } from 'ng2-interceptors';

/**
*	This class represents the lazy loaded DashboardComponent.
*/

@Component({
	moduleId: module.id,
	selector: 'dashboard-cmp',
	templateUrl: 'dashboard.component.html'
})

export class DashboardComponent {
	constructor (private _http: InterceptorService) {
	}
}
