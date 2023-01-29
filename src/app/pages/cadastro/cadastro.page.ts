import { Component, OnInit, ViewChild } from '@angular/core';

@Component({
  selector: 'app-cadastro',
  templateUrl: './cadastro.page.html',
  styleUrls: ['./cadastro.page.scss'],
})
export class CadastroPage  {

  constructor() { }
  @ViewChild('popover1') popover1: any;
  @ViewChild('popover2') popover2: any;

  isOpen1 = false;
  isOpen2 = false;

  popoverCons(e1: Event) {
    this.popover1.event = e1;
    this.isOpen1 = true;
  }

  popoverCooperado(e2: Event) {
    this.popover2.event = e2;
    this.isOpen2 = true;
  }

}
