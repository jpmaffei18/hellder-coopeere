import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LegalizacaoPage } from './legalizacao.page';

const routes: Routes = [
  {
    path: '',
    component: LegalizacaoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LegalizacaoPageRoutingModule {}
