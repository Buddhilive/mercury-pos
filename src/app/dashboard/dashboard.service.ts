import { HttpClient } from "@angular/common/http";
import { inject, Injectable } from "@angular/core";

@Injectable()
export class DashboardService {
    private httpClient = inject(HttpClient);

    welcome() {
        return this.httpClient.get('/api');
    }
}