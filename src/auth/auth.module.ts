import { Module } from '@nestjs/common';
import { JwtModule } from '@nestjs/jwt';
import { PassportModule } from '@nestjs/passport';


import { AuthService } from './auth.service';
import { jwtConstants } from './constants';
import { JwtStrategy } from './jwt.strategy';
import { LocalStrategy } from './local.strategy';
import { PersonModule } from 'src/modules/person.module';
import { Bcrypt } from './bcrypt';

@Module({
  imports: [
    PersonModule, //
    PassportModule, 
     
    JwtModule.register({
      secret: jwtConstants.secret,
      signOptions: { expiresIn: '60s' },
    }),],
  providers: [
    Bcrypt,
    AuthService, 
    LocalStrategy, 
    JwtStrategy, 
  ],
  exports: [
    JwtModule, 
    AuthService,
    Bcrypt 
  ]
})
export class AuthModule {}
