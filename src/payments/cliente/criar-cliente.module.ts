import { Module } from '@nestjs/common';
import { CriarClienteController } from "./criar-cliente.controller";
import { CriarClienteService } from "./criar-cliente.service";
import { PaymentsModule } from '../payments-resource/payments.module';
import { UsersModule } from 'src/users/users.module';


@Module({
    imports: [UsersModule],
    controllers: [CriarClienteController],
    providers: [CriarClienteService],
})

export class CriarClienteModule {}