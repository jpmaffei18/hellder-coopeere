import { Controller, Get, Post, Body, Patch, Param, Delete } from '@nestjs/common';
import { PaymentsService } from './payments.service';
import { CreatePaymentDto } from './dto/create-payment.dto';
import { UpdatePaymentDto } from './dto/update-payment.dto';
import { CriarCliente } from '../cliente/criar-cliente.entity';
import { CriarPagamento } from './entities/payment-resource.entity';

@Controller('payments')
export class PaymentsController {
  constructor(private readonly paymentsService: PaymentsService) {}

  @Post('/createCustomer')
  async createCustomer(
    @Body('nome') nome: string,
    @Body('email') email: string,
  ): Promise<CriarCliente[]> {
    return this.paymentsService.createCustomer(nome, email);
  }

  @Post()
  async create(@Body() createPaymentDto: CreatePaymentDto): Promise<CriarPagamento> {
    return this.paymentsService.create(createPaymentDto);
  }

  @Get()
  async findAll(): Promise<CriarCliente[]> {
    return this.paymentsService.findAll();
  }

  @Get(':id')
  async findOne(@Param('id') id: string): Promise<CriarCliente> {
    return this.paymentsService.findOne(parseInt(id));
  }

  @Patch(':id')
  async update(
    @Param('id') id: string,
    @Body() updatePaymentDto: UpdatePaymentDto,
  ): Promise<CriarCliente> {
    return this.paymentsService.update(parseInt(id), updatePaymentDto);
  }

  @Delete(':id')
  async remove(@Param('id') id: string): Promise<void> {
    return this.paymentsService.remove(parseInt(id));
  }
}
