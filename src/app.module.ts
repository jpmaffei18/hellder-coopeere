import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import { UsersModule } from './users/users.module';
import { AuthModule } from './auth/auth.module';
import { AsaasService } from './payments/asaas.service';
import { AsaasController } from './payments/asaas.controller';


@Module({
  imports: [UsersModule, AuthModule],
  controllers: [AppController, AsaasController],
  providers: [AppService, AsaasService],
})
export class AppModule {}
