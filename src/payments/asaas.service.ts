import { Injectable } from '@nestjs/common';
import axios from 'axios';

@Injectable()
export class AsaasService {
  private readonly baseUrl = 'https://www.asaas.com/api/v3';

  async criarCliente(name: string, email: string): Promise<any> {
    const response = await axios.post(`${this.baseUrl}/customers`, {
      name,
      email,
    }, {
      headers: {
        'access_token': 'seu_token_de_acesso_ao_asaas',
      },
    });
    return response.data;
  }

  async createInvoice(email: string, description: string, value: number): Promise<any> {
    const response = await axios.post(`${this.baseUrl}/payments`, {
      customer: email,
      billingType: 'BOLETO',
      dueDate: '2022-02-28',
      value,
      description,
    }, {
      headers: {
        'access_token': 'seu_token_de_acesso_ao_asaas',
      },
    });
    return response.data;
  }


  async createPayment(customerId: string): Promise<any>{
    const response = await axios.post(`${this.baseUrl}/payments`)
  }

}
