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
  

}
