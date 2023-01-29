import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Usuario } from 'src/app/interfaces/usuario';
import { UsuarioService } from 'src/app/services/users.service';

@Component({
  selector: 'app-register',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
})
export class SignupPage implements OnInit {

  constructor(
    private formBuilder:  FormBuilder,
    private usersService: UsuarioService,
    public navCtrl: NavController
  ) { }

  ngOnInit(): void {
    this.validaForm();
  }

  usuario: Usuario = {
    id: 0,
   
    name: "",
    secondname: "",
    b_day: "",
    genre: "",
    phonenumber: 0,
    cep: 0,
    address: "",
    city: "",
    state: "",

    email: "",
    username: "",
    password: ""
  }

  formulario!: FormGroup;

  validaForm(){
    this.formulario = this.formBuilder.group({
    
      name: ['', [Validators.required]],
      secondname: ['', [Validators.required]],
      b_day: ['', [Validators.required]],
      genre: ['', [Validators.required]],
      phonenumber: ['', [Validators.required]],
      cep: ['', [Validators.required]],
      address: ['', [Validators.required]],
      city: ['', [Validators.required]],
      state: ['', [Validators.required]],
      email: ['', [Validators.required]],
      username: ['', [Validators.required]],
      password: ['', [Validators.required]]
    });
  }

  cadastro(): void{
    const data = {
    
    name: this.usuario.name,
    secondname: this.usuario.secondname,
    b_day: this.usuario.b_day,
    genre: this.usuario.genre,
    phonenumber: this.usuario.phonenumber,
    cep: this.usuario.cep,
    address: this.usuario.address,
    city: this.usuario.city,
    state: this.usuario.state,
    email: this.usuario.email,
    username: this.usuario.username,
    password: this.usuario.password,
   
    };
    this.usersService.create(data)
    .subscribe({
    next: (res) => {
    console.log(res);
    this.navCtrl.navigateForward('/login');
    },
    error: (e) => console.error(e)
    });
  }
}