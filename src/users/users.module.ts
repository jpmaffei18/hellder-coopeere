import { Module } from '@nestjs/common';
import { UsersService } from './users.service';
import { UsersController } from './users.controller';

import { usersProviders } from './users.providers';
import { Bcrypt } from 'src/auth/bcrypt/bcrypt';
import { DatabaseModule } from 'src/database/database.module';

@Module({
  imports: [DatabaseModule],
  controllers: [UsersController],
  providers: [

    //... SPREAD OPERATOR -> útil para a abstração e seleção de informações relevantes. 

    //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Reference/Operators/Spread_syntax

    ...usersProviders,
    UsersService, Bcrypt
  ],
  exports: [UsersService]
})
export class UsersModule {}
