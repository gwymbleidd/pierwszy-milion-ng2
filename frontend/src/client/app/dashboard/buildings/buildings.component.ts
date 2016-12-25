import { Component } from '@angular/core';
import { InterceptorService } from 'ng2-interceptors';

/**
*	This class represents the lazy loaded SignupComponent.
*/

@Component({
	moduleId: module.id,
	selector: 'buildings-cmp',
	templateUrl: './buildings.component.html'
})

export class BuildingsComponent { 
	constructor (private _http: InterceptorService) {
	}
	
	public test() {
		var body = {
			id: 'test'
		}
		this._http.get('/building/list', {})
		    .map(res => res.json())
		    .subscribe(
		    );
	}
}
