import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LegalizacaoPageRoutingModule } from './legalizacao-routing.module';

import { LegalizacaoPage } from './legalizacao.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LegalizacaoPageRoutingModule
  ],
  declarations: [LegalizacaoPage]
})
export class LegalizacaoPageModule {}
