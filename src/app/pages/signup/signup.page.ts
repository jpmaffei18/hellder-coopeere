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
  
  name: "",
  s_name: "",
  bday: null,
  genre: "",
  cpfcnpj: 0,
  
  phonenumber: 0,

  cep: 0,
    address: "",
    city: "",
    state: "",

  usuario: "",
  email: "",
  senha: ""
}



formulario!: FormGroup;

validaForm(){
  this.formulario = this.formBuilder.group({
    
    nome: ['', [Validators.required]],
    sobrenome: ['', [Validators.required]],

    nascimento: ['', [Validators.required]],
    genero: ['', [Validators.required]],
    cpfcnpj: ['', [Validators.required]],
    telefone: ['', [Validators.required]],
    cep: ['', [Validators.required]],
    endereco: ['', [Validators.required]],

    

    cidade: ['', [Validators.required]],
    estado: ['', [Validators.required]],
    
    usuario: ['', [Validators.required]],
    email: ['', [Validators.required]],
    senha: ['', [Validators.required]]
  });
}

cadastro(): void{
  const data = {

  nome: this.usuario.name,
  sobrenome: this.usuario.s_name,
  nascimento: this.usuario.s_name,
  cpfcnpj: this.usuario.cpfcnpj,
  telefone: this.usuario.phonenumber,
  cep: this.usuario.cep,
  endereco: this.usuario.address,
  cidade: this.usuario.city,
  estado: this.usuario.state,

  usuario: this.usuario.usuario,
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
