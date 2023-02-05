import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-onboarding',
  templateUrl: './onboarding.page.html',
  styleUrls: ['./onboarding.page.scss'],
})
export class OnboardingPage implements OnInit  {
 
  slideOpts = {
    autoplay: {
      delay: 4000
    },
    loop: true
  };


  selectedOption: string;
  
  constructor(private navCtrl: NavController) {
    this.selectedOption = "1";

   
  }


  onOptionSelected(option: string) {
    
    switch (option) {
      case "1":
        this.navCtrl.navigateForward('/quemsomos');
        break;
      case "2":
        this.navCtrl.navigateForward('/objetivos');
        break;
      case "3":
        this.navCtrl.navigateForward('/equipe');
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

}


}