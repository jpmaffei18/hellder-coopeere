import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Usuario } from 'src/app/interfaces/usuario';
import { UsuarioService } from 'src/app/services/usuario.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
})
export class SignupPage implements OnInit {

  
  selectedOption: string = '';
 
  constructor(
    private router: Router,
    private formBuilder: FormBuilder,
    private usuarioService: UsuarioService,
    public navCtrl: NavController


    ) {}

  goToPage(option: string) {
    switch (option) {
      case 'option1':
        this.router.navigateByUrl('/option1');
        break;
      case 'option2':
        this.router.navigateByUrl('/option2');
        break;
      case 'option3':
        this.router.navigateByUrl('/option3');
        break;
      default:
        break;
    }

  }

openExternalLinkFacebook(){
  window.open('https://www.facebook.com', '_blank')
}

openExternalLinkInstagram(){
  window.open('https://www.instagram.com', '_blank')
}

openExternalLinkYouTube(){
  window.open('https://www.youtube.com', '_blank')
}

ngOnInit(): void{
  this.validaForm();
}

usuario: Usuario = {
  id: 0,
  usuario: "",
  name: "",
  bday: date,
  genre: "",
  cpfcnpj: 0,
  secondname: "",
  phonenumber: 0,

  cep: 0,
    address: "",
    city: "",
    state: "",


  email: "",
  senha: ""
}

/*
    name: string;
    secondname: string;
    bday: Date;
    genre: string;
    cpfcnpj: number;
    phonenumber: number;
    cep: number;
    address: string;
    city: string;
    state: string;
        email: string;
        username: string;
        password: string;

*/

formulario!: FormGroup;

validaForm(){
  this.formulario = this.formBuilder.group({
    usuario: ['', [Validators.required]],
    nome: ['', [Validators.required]],
    telefone: ['', [Validators.required]],
    email: ['', [Validators.required]],
    senha: ['', [Validators.required]]
  });
}

cadastro(): void{
  const data = {
  usuario: this.usuario.usuario,
  nome: this.usuario.name,
  telefone: this.usuario.phonenumber,
  email: this.usuario.email,
  senha: this.usuario.senha
  };
  this.usuarioService.create(data)
  .subscribe({
  next: (res) => {
  console.log(res);
  this.navCtrl.navigateForward('/login');
  },
  error: (e) => console.error(e)
  });
}

}
