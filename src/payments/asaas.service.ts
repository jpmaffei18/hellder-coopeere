import { Injectable } from '@nestjs/common';
import axios from 'axios';
import { asaasConfig } from './asaas.config';

@Injectable()
export class AsaasService {
  private readonly apiUrl = asaasConfig.apiUrl;
  private readonly apiToken = asaasConfig.apiToken;

  public async createPayment(data: any) {
    const url = `${this.apiUrl}/payments`;
    const headers = {
      'Content-Type': 'application/json',
      'access_token': this.apiToken,
    };
    const response = await axios.post(url, data, { headers });
    return response.data;
  }


  async createCustomer(data: any){
    const customer = `${this.apiUrl}/api/v3/customers`;
    
  }
}


/*

Demetrius Ferreira <engdemeferreira@gmail.com>
	
4:29 PM (2 minutes ago)
	
to me
$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAyNzE5NjM6OiRhYWNoXzQ0ZmM1YTJhLWQyZGQtNDA3Zi1hZGQxLTM5YzAyMzhhZjI0OQ==
*/



/*


constructor(private httpService: HttpService){}

    async charge(value: number, customer: string){
        const charge = await this.assas.charges.create({
            value,
            customer,
            description: "Exemplo de cobrança",
        });
        return charge    
    }


*/

    //private assas: any
    /*  this.assas = new this.assas(asaasConfig);*/