import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import {DataTableModule,SharedModule, DialogModule, ButtonModule, ConfirmDialogModule, CalendarModule, ConfirmationService} from 'primeng/primeng';
import { FormsModule } from '@angular/forms';
import { BrowserModule }  from '@angular/platform-browser';
import { CitiesComponent } from './cities.component';

@NgModule({
    imports: [RouterModule, DataTableModule, FormsModule, BrowserModule, DialogModule, ButtonModule, ConfirmDialogModule, CalendarModule],
    declarations: [CitiesComponent],
    exports: [CitiesComponent],
    providers: [
		ConfirmationService
	]
})

export class CitiesModule { }