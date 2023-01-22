import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { OnboardingPostloginPageRoutingModule } from './onboarding-postlogin-routing.module';

import { OnboardingPostloginPage } from './onboarding-postlogin.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    OnboardingPostloginPageRoutingModule
  ],
  declarations: [OnboardingPostloginPage]
})
export class OnboardingPostloginPageModule {}
