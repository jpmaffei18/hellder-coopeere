import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule)
  },
  {
    path: 'info',
    loadChildren: () => import('./pages/info/info.module').then( m => m.InfoPageModule)
  },
  {
    path: 'termos',
    loadChildren: () => import('./pages/termos/termos.module').then( m => m.TermosPageModule)
  },
  {
    path: 'politica',
    loadChildren: () => import('./pages/politica/politica.module').then( m => m.PoliticaPageModule)
  },
  {
    path: 'alterarsenha',
    loadChildren: () => import('./pages/alterarsenha/alterarsenha.module').then( m => m.AlterarsenhaPageModule)
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'signup',
    loadChildren: () => import('./pages/signup/signup.module').then( m => m.SignupPageModule)
  }
];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
