import { Component } from '@angular/core';
import { InterceptorService } from 'ng2-interceptors';
import {DataTableModule,SharedModule,ConfirmationService, DropdownModule, CalendarModule} from 'primeng/primeng';
import {URLSearchParams, QueryEncoder,RequestOptions, Request, RequestMethod} from '@angular/http';

@Component({
	moduleId: module.id,
	selector: 'cities-cmp',
	templateUrl: './cities.component.html'
})

export class CitiesComponent {
	cities: any[];
	totalRecords = 0;

    displayDialog: boolean;
    newCity: boolean;
	city: City = new City();
    selectedCity: City;

		constructor (private _http: InterceptorService, private _confirmationService: ConfirmationService) {
	}

	loadCitiesLazy(event: LazyLoadEvent) {
		this._http.get('/city/list')
		    .map(res => res.json())
		    .subscribe(res => {
		    	this.cities = res.data;
		    });
    }

    showDialogToAdd() {
	    this.newCity = true;
	    this.city = new City();
	    this.displayDialog = true;
	}

	showCity(city: City) {
        this.selectedCity = city;
        displayDialog = false;
    }

    onRowSelect(event) {
        this.newCity = false;
        this.city = this.cloneCity(event.data);
        this.displayDialog = false;
        this.selectedCity = this.city;
    }

    editCity(city: City) {
        this.city = city;
        this.selectedCity = this.city;
        this.displayDialog = true;
    }

    cloneCity(c: City): City {
        let city = new City();
        for(let prop in c) {
            city[prop] = c[prop];
        }
        return city;
    }

    decline() {
    	 this._confirmationService.confirm({
                message: 'Twoje zmiany zostaną niezapisane. Czy na pewno anulować akcję?',
                accept: () => {
                	this.displayDialog = false;
    			}
       });
    }

    save() {
        var headers = new Headers();
        headers.append('Content-Type', 'application/json');
        var body = JSON.stringify(this.city);
        if(this.newCity) {
          this._http.post('/city', body, {
            headers: headers
            })
            .map(res => res.json())
            .subscribe(
              data => {
                this.city.id = data.data;
                this.displayDialog = false;
                this.cities.push(this.city);
              },
              err => console.log(err)
            );
        }
    }

    findSelectedCityIndex() : number {
   	if (this.selectedCity) {
            for (let i in this.cities) {
               if (this.cities[i].id === this.selectedCity.id) {
                   return i;
               }
            }
        }
        return -1;
    }
}

class City {
    
    constructor(public name?, public start_date?, public end_date?) {}
}