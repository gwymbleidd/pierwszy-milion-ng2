import { Component } from '@angular/core';
import { InterceptorService } from 'ng2-interceptors';
import {DataTableModule,SharedModule,ConfirmationService} from 'primeng/primeng';
import {URLSearchParams, QueryEncoder,RequestOptions, Request, RequestMethod} from '@angular/http';

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

	constructor (private _http: InterceptorService, private _confirmationService: ConfirmationService) {
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
        var headers = new Headers();
        headers.append('Content-Type', 'application/json');
        var body = JSON.stringify(this.building);
        if(this.newBuilding) {
          this._http.post('/building', body, {
            headers: headers
            })
            .map(res => res.json())
            .subscribe(
              data => {
                this.building.id = data.data;
                this.displayDialog = false;
                this.buildings.push(this.building);
              },
              err => console.log(err)
            );
        }
        else {
            this._confirmationService.confirm({
                message: 'Are you sure that you want to perform this action?',
                accept: () => {
                    this._http.put('/building/' + this.building.id, body, {
                        headers: headers
                    })
                    .map(res => res.json())
                    .subscribe(
                        data => { 
                            this.buildings[this.findSelectedBuildingIndex()] = this.building;
                            this.building = null;
                            this.displayDialog = false;

                        },
                        err => console.log(err)
                    );
                }
            });
        }
    }
    
    delete() {
        this._confirmationService.confirm({
            message: 'Are you sure that you want to perform this action?',
            accept: () => {
                this._http.delete('/building/' + this.building.id)
                .map(res => res.json())
                .subscribe(
                    data => { 
                        this.building = null;
                        this.displayDialog = false;
                        this.buildings.splice(this.findSelectedBuildingIndex(), 1);
                    },
                    err => console.log(err)
                );
            }
        });

    }    
    
    onRowSelect(event) {
        this.newBuilding = false;
        this.building = this.cloneBuilding(event.data);
        this.displayDialog = true;
        this.selectedBuilding = this.building;
    }
    
    cloneBuilding(b: Building): Building {
        let building = new Building();
        for(let prop in b) {
            building[prop] = b[prop];
        }
        return building;
    }
    
    findSelectedBuildingIndex(): number {
        if (this.selectedBuilding) {
            for (let i in this.buildings) {
               if (this.buildings[i].id === this.selectedBuilding.id) {
                   return i;
               }
            }
        }
        return -1;
    }
}

class Building {
    
    constructor(public name?, public price?, public width?, public height?) {}
}