import { Component, OnInit } from '@angular/core';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss'],
})
export class HomePage  {

  constructor(private alertController: AlertController) { }

  async alertAssociado() {
    const alert = await this.alertController.create({
      header: 'Bio',
      subHeader: 'Hellder Benjamim',
      message: 'CPF: 000.000.000-00',
      buttons: ['OK'],
    });

    await alert.present();
  }

  async alertContato() {
    const alertC = await this.alertController.create({
      header: 'Contatos',
      subHeader: 'Telefone Celular',
      message: '(22)99999-9999!',
      buttons: ['OK'],
    });

    await alertC.present();
  }

  async alertEndereco() {
    const alertE = await this.alertController.create({
      header: 'Endereço',
      subHeader: 'Endereço Completo',
      message: ' Rua Professora Agricolina de Freitas, 23 Campos dos Goytacazes - RJ, Centro - 28013015',
      buttons: ['OK'],
    });

    await alertE.present();
  }

}
