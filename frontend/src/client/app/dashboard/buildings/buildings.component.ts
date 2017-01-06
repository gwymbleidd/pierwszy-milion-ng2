import { Component } from '@angular/core';
import { InterceptorService } from 'ng2-interceptors';
import {DataTableModule,SharedModule} from 'primeng/primeng';
import {URLSearchParams, QueryEncoder} from '@angular/http';

@Component({
	moduleId: module.id,
	selector: 'buildings-cmp',
	templateUrl: './buildings.component.html'
})

export class BuildingsComponent {
	buildings: any[];
	totalRecords = 0;

    displayDialog: boolean;
    newBuilding: boolean;

    building: Building = new Building();
    selectedBuilding: Building;

	constructor (private _http: InterceptorService) {
	}

    loadBuildingsLazy(event: LazyLoadEvent) {
		let params: URLSearchParams = new URLSearchParams();
		params.set('query', '');
		params.set('limit', 10);
		if (event.sortField == undefined) {
			event.sortField = 'name';
		}
		params.set('orderBy', event.sortField);
		params.set('ascending', event.sortOrder);
		params.set('page', event.first/10 + 1);

        this.totalRecords = 1000;
		this._http.get('/building/list', { search: params })
		    .map(res => res.json())
		    .subscribe(res => {
		    	this.buildings = res.data;
		    	this.totalRecords = res.count;
		    });
    }

    showDialogToAdd() {
        this.newBuilding = true;
        this.building = new Building();
        this.displayDialog = true;
    }
    
    save() {
    	console.log(this.building);
        if(this.newBuilding)
            this.buildings.push(this.building);
        else
            this.buildings[this.findSelectedBuildingIndex()] = this.building;
        
        this.building = null;
        this.displayDialog = false;
    }
    
    delete() {
        this.buildings.splice(this.findSelectedBuildingIndex(), 1);
        this.building = null;
        this.displayDialog = false;
    }    
    
    onRowSelect(event) {
        this.newBuilding = false;
        this.building = this.cloneBuilding(event.data);
        this.displayDialog = true;
    }
    
    cloneBuilding(b: Building): Building {
        let building = new Building();
        for(let prop in b) {
            building[prop] = b[prop];
        }
        return building;
    }
    
    findSelectedBuildingIndex(): number {
        return this.buildings.indexOf(this.selectedBuilding);
    }
}

class Building {
    
    constructor(public name?, public price?, public width?, public height?) {}
}