import { Routes } from '@angular/router';

import { LoginRoutes } from './login/index';
import { SignupRoutes } from './signup/index';
import { DashboardRoutes } from './dashboard/index';
import { BuildingsRoutes } from './buildings/index';
import { CitiesRoutes } from './cities/index';

import { LoginComponent } from './login/index';

export const routes: Routes = [
	...LoginRoutes,
	...SignupRoutes,
	...DashboardRoutes,
	{ path: '**', component: LoginComponent }
];
