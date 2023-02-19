import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { CriarCliente } from '../cliente/criar-cliente.entity';
import { AsaasService } from '../asaas.service';

@Injectable()
export class InvoiceService {
  constructor(
    @InjectRepository(CriarCliente)
    private readonly customerRepository: Repository<CriarCliente>,
    private readonly asaasService: AsaasService,
  ) {}

  async createInvoice(customerId: string, email: string, description: string, value: number) {
    const customer = await this.customerRepository.findOne({
      
      where: {
        customerId
      
      },
    
    
    }); // esse customer supostamente deveria estar guardado no banco de dados
    const invoice = await this.asaasService.createInvoice(
      customer.customerId,
     // customer.email,
      description,
      value,
    );
    // ...

    
  }
}
