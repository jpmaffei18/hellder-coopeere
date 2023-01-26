import { Component } from '@angular/core';
import { NavController, NavParams, ToastController } from '@ionic/angular';
//import { IonicPage } from 'ionic-angular';
import { UsersService } from 'src/app/users.service';


@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
})
export class SignupPage  {
  model: User

  constructor(public navCtrl: NavController, public navParams: NavParams, private toast: ToastController, private usersService: UsersService) { 
    this.model = new User();
    this.model.email = 'demi@senac';
    this.model.password = 'senha';
  }

  createAccount(){
    this.usersService.createAccount(this.model.email, this.model.password)
      .then((result: any) => {
        this.toast.create({ message: 'O Usuário foi criado com sucesso Token: ' + result.token, position: 'bottom', duration: 3000})  //.present();

        /*
        Esse processo vai salvar o token para requests futuras (this.navCtrl.pop()). o navCtrl redirecionará o usuário para outra tela (this.navCtrl.setRoot()) 

        */


      }) 

      .catch((error: any) => {
        this.toast.create({ message: 'Erro ao criar usuário. Erro:  ' + error.error, position: 'bottom', duration: 3000}) //.present();
      });



  }


  

}

export class User {
  email: string = "";
  password: string = ""; 
}

