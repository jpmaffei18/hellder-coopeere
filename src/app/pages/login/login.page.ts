import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage {

  constructor(public navCtrl: NavController) { }

openCreateAccount(){
  this.navCtrl.navigateForward('CreateAccountPage')
}

openLogin(){
  this.navCtrl.navigateForward('LoginPage')
}

openListUsers(){
  this.navCtrl.navigateForward('UserListPage')
}

}
