import { Component } from '@angular/core';
@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {
  public appPages = [
    { title: 'Home', url: '/home', icon: 'home' },
    { title: 'Cadastro', url: '/cadastro', icon: 'settings' },
    { title: 'Perfil', url: '/folder/Favorites', icon: 'person' },

    { title: 'Informações Pessoais', url: '/folder/Info', icon: 'person-cicle-outline' },

    { title: 'Regulamento', url: '/regulamento', icon: 'document-text-outline ' },
    { title: 'Sorteio', url: '/sorteio', icon: 'flower-outline' },
    { title: 'Convite', url: '/convite', icon: 'chatbubbles-outline' },
    { title: 'Sair', url: '/sair', icon: 'arrow-back-circle-outline' },
  
  ];
  
  constructor() {}
}

/*   




      <ion-label [routerLink]="['/tabs/tab1']">Informações Pessoais</ion-label>
      <ion-label [routerLink]="['/tabs/tab2']">Cadastro</ion-label>
      <ion-label [routerLink]="['/regulamento']" >Regulamento</ion-label>
      <ion-label [routerLink]="['/sorteio']">Sorteio</ion-label>
      <ion-label [routerLink]="['/convite']" >Convite </ion-label>
      <ion-label [routerLink]="['/login']">Sair</ion-label>
  
*/