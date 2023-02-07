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
  },
  {
    path: 'onboarding',
    loadChildren: () => import('./pages/onboarding/onboarding.module').then( m => m.OnboardingPageModule)
  },
  {
    path: 'quemsomos',
    loadChildren: () => import('./pages/quemsomos/quemsomos.module').then( m => m.QuemsomosPageModule)
  },
  {
    path: 'objetivos',
    loadChildren: () => import('./pages/objetivos/objetivos.module').then( m => m.ObjetivosPageModule)
  },
  {
    path: 'equipe',
    loadChildren: () => import('./pages/equipe/equipe.module').then( m => m.EquipePageModule)
  },

  {
    path: 'estatuto', //
    loadChildren: () => import('./pages/estatuto/estatuto.module').then( m => m.EstatutoPageModule)
  },
  {
    path: 'vantagens',
    loadChildren: () => import('./pages/vantagens/vantagens.module').then( m => m.VantagensPageModule)
  },
  {
    path: 'parceiros',
    loadChildren: () => import('./pages/parceiros/parceiros.module').then( m => m.ParceirosPageModule)
  },
  {
    path: 'faleconosco',
    loadChildren: () => import('./pages/faleconosco/faleconosco.module').then( m => m.FaleconoscoPageModule)
  },
  {
    path: 'eventos',
    loadChildren: () => import('./pages/eventos/eventos.module').then( m => m.EventosPageModule)
  },
  {
    path: 'agenda',
    loadChildren: () => import('./pages/agenda/agenda.module').then( m => m.AgendaPageModule)
  },
  {
    path: 'galeria',
    loadChildren: () => import('./pages/galeria/galeria.module').then( m => m.GaleriaPageModule)
  },
  {
    path: 'publicacoes',
    loadChildren: () => import('./pages/publicacoes/publicacoes.module').then( m => m.PublicacoesPageModule)
  },
  {
    path: 'legislacao',
    loadChildren: () => import('./pages/legislacao/legislacao.module').then( m => m.LegislacaoPageModule)
  }

];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
