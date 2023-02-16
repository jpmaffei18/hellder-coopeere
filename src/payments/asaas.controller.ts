import { Body, Controller, Post } from '@nestjs/common';
import { AsaasService } from './asaas.service';

@Controller('payments')
export class AsaasController {
  constructor(private readonly asaasService: AsaasService) {}

  @Post()
  async createPayment(@Body() data: any) {
    const payment = await this.asaasService.createPayment(data);
    return payment;
  }
}
