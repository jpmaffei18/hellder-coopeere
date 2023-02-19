import { Controller, Post, Body } from '@nestjs/common';
import { AsaasService } from './asaas.service';

@Controller('asaas')
export class AsaasController {
  constructor(private readonly asaasService: AsaasService) {}

  @Post('clientes')
  async criarCliente(@Body('name') name: string, @Body('email') email: string): Promise<any> {
    return this.asaasService.criarCliente(name, email);
  }

  @Post('faturas')
  async criarFatura(@Body('email') email: string, @Body('description') description: string, @Body('value') value: number): Promise<any> {
    return this.asaasService.createInvoice(email, description, value);
  }
//
  @Post('pagamentos')
  async criarPagamento(@Body('customerId') customerId: string): Promise<any>{
    return this.asaasService.createPayment(customerId);
  }
}
