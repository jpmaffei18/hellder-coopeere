import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ConvitePageRoutingModule } from './convite-routing.module';

import { ConvitePage } from './convite.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ConvitePageRoutingModule
  ],
  declarations: [ConvitePage]
})
export class ConvitePageModule {}
