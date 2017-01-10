import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import {DataTableModule,SharedModule, DialogModule, ButtonModule, ConfirmDialogModule, ConfirmationService} from 'primeng/primeng';
import { FormsModule } from '@angular/forms';
import { BrowserModule }  from '@angular/platform-browser';
import { BuildingsComponent } from './buildings.component';

@NgModule({
    imports: [RouterModule, DataTableModule, FormsModule, BrowserModule, DialogModule, ButtonModule, ConfirmDialogModule],
    declarations: [BuildingsComponent],
    exports: [BuildingsComponent],
    providers: [
		ConfirmationService
	]
})

export class BuildingsModule { }