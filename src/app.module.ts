import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { UsersModule } from './users/users.module';
import { AuthModule } from './auth/auth.module';
import { AsaasService } from './payments/asaas.service';
import { AsaasController } from './payments/asaas.controller';
import { PaymentsModule } from './payments/payments-resource/payments.module';
import { CriarClienteModule } from './payments/cliente/criar-cliente.module';
import { CriarClienteController } from './payments/cliente/criar-cliente.controller';
import { PaymentsService } from './payments/payments-resource/payments.service';
import { CriarClienteService } from './payments/cliente/criar-cliente.service';
import { PaymentsController } from './payments/payments-resource/payments.controller';
import { UsersController } from './users/users.controller';
import { UsersService } from './users/users.service';


@Module({
  imports: [UsersModule, AuthModule, PaymentsModule, CriarClienteModule],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
