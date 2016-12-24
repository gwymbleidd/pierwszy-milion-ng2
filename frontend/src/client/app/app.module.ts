import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { APP_BASE_HREF } from '@angular/common';
import { RouterModule } from '@angular/router';
import { HttpModule } from '@angular/http';
import { AppComponent } from './app.component';
import { routes } from './app.routes';
import { LoginModule } from './login/login.module';
import { SignupModule } from './signup/signup.module';
import { DashboardModule } from './dashboard/dashboard.module';
import { SharedModule } from './shared/shared.module';
import { InterceptorService } from 'ng2-interceptors';
import { XHRBackend, RequestOptions } from '@angular/http';
import { ServerURLInterceptor } from './services/serverURLInterceptor';
import { GlobalStateService } from './globalstate.service';

export function interceptorFactory(xhrBackend: XHRBackend, requestOptions: RequestOptions, interceptor: ServerURLInterceptor){
  let service = new InterceptorService(xhrBackend, requestOptions);
  service.addInterceptor(interceptor);
  return service;
}

@NgModule({
	imports: [
		BrowserModule,
		HttpModule,
		RouterModule.forRoot(routes),
		LoginModule,
		HttpModule,
		SignupModule,
		DashboardModule,
		SharedModule.forRoot()
	],
	declarations: [AppComponent],
	providers: [
		GlobalStateService,
		ServerURLInterceptor,
		{
			provide: InterceptorService,
			useFactory: interceptorFactory,
			deps: [XHRBackend, RequestOptions, ServerURLInterceptor],
			useValue: '<%= APP_BASE %>'
		}
	],
	bootstrap: [AppComponent],

})

export class AppModule { }
