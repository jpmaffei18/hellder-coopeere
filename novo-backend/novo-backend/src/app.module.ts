import { Module } from '@nestjs/common';

import { UsersModule } from './users/users.module';
import { MongooseModule } from '@nestjs/mongoose';

@Module({
  imports: [ UsersModule,
    MongooseModule.forRoot('mongodb+srv://demithehomie:k5o328jznhcFaJ1X@cluster0.0gsouwa.mongodb.net/test'),
  ],
  controllers: [],
  providers: [], 
})
export class AppModule {}
