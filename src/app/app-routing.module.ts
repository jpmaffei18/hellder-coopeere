import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule)
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'signup',
    loadChildren: () => import('./pages/signup/signup.module').then( m => m.SignupPageModule)
  },
  {
    path: 'painel',
    loadChildren: () => import('./pages/painel/painel.module').then( m => m.PainelPageModule)
  },
  {
    path: 'onboarding',
    loadChildren: () => import('./pages/onboarding/onboarding.module').then( m => m.OnboardingPageModule)
  },
  {
    path: 'onboarding-postlogin',
    loadChildren: () => import('./pages/onboarding-postlogin/onboarding-postlogin.module').then( m => m.OnboardingPostloginPageModule)
  },
  {
    path: 'payments',
    loadChildren: () => import('./pages/payments/payments.module').then( m => m.PaymentsPageModule)
  },
  {
    path: 'regulamento',
    loadChildren: () => import('./pages/regulamento/regulamento.module').then( m => m.RegulamentoPageModule)
  },
  {
    path: 'sorteio',
    loadChildren: () => import('./pages/sorteio/sorteio.module').then( m => m.SorteioPageModule)
  },
  {
    path: 'convite',
    loadChildren: () => import('./pages/convite/convite.module').then( m => m.ConvitePageModule)
  }
];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
