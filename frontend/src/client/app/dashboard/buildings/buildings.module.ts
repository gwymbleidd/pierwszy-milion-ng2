import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { BuildingsComponent } from './buildings.component';

@NgModule({
    imports: [RouterModule],
    declarations: [BuildingsComponent],
    exports: [BuildingsComponent]
})

export class BuildingsModule { }