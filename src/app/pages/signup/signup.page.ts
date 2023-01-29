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
    username: "",
    nome: "",
    telefone: "",
    email: "",
    password: ""
  }

  formulario!: FormGroup;

  validaForm(){
    this.formulario = this.formBuilder.group({
      username: ['', [Validators.required]],
      nome: ['', [Validators.required]],
      telefone: ['', [Validators.required]],
      email: ['', [Validators.required]],
      password: ['', [Validators.required]]
    });
  }

  cadastro(): void{
    const data = {
    username: this.usuario.username,
    nome: this.usuario.nome,
    telefone: this.usuario.telefone,
    email: this.usuario.email,
    password: this.usuario.password
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