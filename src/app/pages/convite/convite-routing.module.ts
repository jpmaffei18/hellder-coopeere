import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ConvitePage } from './convite.page';

const routes: Routes = [
  {
    path: '',
    component: ConvitePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ConvitePageRoutingModule {}
