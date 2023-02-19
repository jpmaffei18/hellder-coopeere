import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { AsaasService } from '../asaas.service';
import { CriarCliente } from '../cliente/criar-cliente.entity';
import { Repository } from 'typeorm';
import { CreatePaymentDto } from './dto/create-payment.dto';
import { UpdatePaymentDto } from './dto/update-payment.dto';
import { CriarPagamento } from './entities/payment-resource.entity';

@Injectable()
export class PaymentsService {

  constructor(
    @InjectRepository(CriarCliente)
    private readonly clienteRepository: Repository<CriarCliente>,
    private readonly paymentRepository: Repository<CriarPagamento>,
    private readonly asaasService: AsaasService,
  ) {}

  async createCustomer(nome: string, email: string): Promise<CriarCliente[]> {
    const customer = await this.asaasService.criarCliente(nome, email);
    const newCustomer = this.clienteRepository.create(customer);
    return this.clienteRepository.save(newCustomer);
  }


  async create(createPaymentDto: CreatePaymentDto): Promise<CriarPagamento> {
    const newPayment = this.paymentRepository.create(createPaymentDto);
    return this.paymentRepository.save(newPayment);
  }

  async findAll(): Promise<CriarCliente[]> {
    return this.clienteRepository.find();
  }

  async findOne(id: number): Promise<CriarCliente> {
    return this.clienteRepository.findOne({
      
      where:{
        id
      } 
    });
  }

  async update(id: number, updatePaymentDto: UpdatePaymentDto): Promise<CriarCliente> {
    const payment = await this.clienteRepository.findOne({
      
      where:{
        id
      } });
    if (!payment) {
      return null;
    }
    const updatedPayment = this.clienteRepository.merge(payment, updatePaymentDto);
    return this.clienteRepository.save(updatedPayment);
  }

  async remove(id: number): Promise<void> {
    await this.clienteRepository.delete(id);
  }
}
