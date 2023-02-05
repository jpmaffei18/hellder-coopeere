import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-onboarding',
  templateUrl: './onboarding.page.html',
  styleUrls: ['./onboarding.page.scss'],
})
export class OnboardingPage  {
 
  slideOpts = {
    autoplay: {
      delay: 4000
    },
    loop: true
  };

  constructor() {}

  openExternalLinkFacebook(){
    window.open('https://www.facebook.com', '_blank')
  }
  
  openExternalLinkInstagram(){
    window.open('https://www.instagram.com', '_blank')
  }

  openExternalLinkYouTube(){
    window.open('https://www.youtube.com', '_blank')
  }

}
