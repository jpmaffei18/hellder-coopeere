import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http'
import { Observable } from 'rxjs';


const usuarioURL = 'http://localhost:3000/';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {

  constructor(private httpClient: HttpClient) { }

  create(data: any): Observable<any>{
    return this.httpClient.post(usuarioURL+'/users/cadastrar',data)
  }

  findAll() {
    return this.httpClient.get(usuarioURL+'/users/all');
  }

  login(body: any): Observable<any> {
    return this.httpClient.post(usuarioURL+'/auth/logar', body);
  }

}
