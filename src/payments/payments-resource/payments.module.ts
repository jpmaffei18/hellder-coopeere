import { Module } from '@nestjs/common';
import { PaymentsService } from './payments.service';
import { PaymentsController } from './payments.controller';
import { CriarClienteModule } from '../cliente/criar-cliente.module';

@Module({
  imports: [],
  controllers: [PaymentsController],
  providers: [PaymentsService]
})
export class PaymentsModule {}
