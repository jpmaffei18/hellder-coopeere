import { Controller, Post, Body } from '@nestjs/common';
import { AsaasService } from '../asaas.service';

@Controller('invoices')
export class InvoiceController {
  constructor(private readonly asaasService: AsaasService) {}

  @Post()
  async createInvoice(
    @Body('email') email: string,
    @Body('description') description: string,
    @Body('value') value: number,
  ): Promise<any> {
    const invoice = await this.asaasService.createInvoice(email, description, value);
    // Aqui você poderia utilizar o TypeORM para salvar a fatura criada no banco de dados
    // ou então retornar a resposta da API do Asaas para o cliente
    return invoice;
  }
}
