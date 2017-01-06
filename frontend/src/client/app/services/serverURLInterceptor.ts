import { Injectable, Component } from '@angular/core'
import { Interceptor, InterceptedRequest, InterceptedResponse } from 'ng2-interceptors';
import { GlobalStateService } from './../globalstate.service';
import { 
  ROUTER_DIRECTIVES, 
  RouteConfig, 
  ROUTER_PROVIDERS, 
  Router 
} from '@angular/router';

@Injectable()
export class ServerURLInterceptor implements Interceptor {
	private unprotectedUrls = ['/login', '/register']

	constructor (private _globalState: GlobalStateService, private _router: Router) {
	}

    public interceptBefore(request: InterceptedRequest): InterceptedRequest {
        if (this.unprotectedUrls.indexOf(request.options.url) == -1 && this._globalState.state.credentials) {
            request.options.url += '?access_token=' + this._globalState.state.credentials.access_token;
        }
        request.options.url = this.getBaseApiUrl() + request.options.url;
        return request;
    }

    public interceptAfter(response: InterceptedResponse): InterceptedResponse {
    	if (response.response.status === 401) {
    		this.handleAccessDenied()
    	}
        return response;
    }

    private getBaseApiUrl() {
    	return this._globalState.config.baseUrl;
    }

    private handleAccessDenied() {
    	this._globalState.logout()
        this._router.navigate(['/login']);
    }
}
