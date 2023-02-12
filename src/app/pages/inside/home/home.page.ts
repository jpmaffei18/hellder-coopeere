import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.page.html',
  styleUrls: ['./home.page.scss'],
})
export class HomePage implements OnInit {

  constructor() { }

  ngOnInit() {

  }

  selectedTab = 'option1';

  nextPage() {
    if (this.selectedTab === 'option1') {
      this.selectedTab = 'option2';
    } else if (this.selectedTab === 'option2') {
      this.selectedTab = 'option3';
    }
  }

  previousPage() {
    if (this.selectedTab === 'option3') {
      this.selectedTab = 'option2';
    } else if (this.selectedTab === 'option2') {
      this.selectedTab = 'option1';
    }
  }

}
