import { Module } from "@nestjs/common";
import { Bcrypt } from "./bcrypt/bcrypt";
import { LocalStrategy } from "./strategy/local.strategy";
import { AuthService } from "./services/auth.service";
import { UsersModule } from "src/users/users.module";
import { PassportModule, PassportStrategy } from "@nestjs/passport";
import { JwtModule } from '@nestjs/jwt';
import { jwtConstants } from "./constants/constants";
import { JwtStrategy } from "./strategy/jwt.strategy";
import { AuthController } from "./controllers/auth.controller";


@Module({
    imports: [
        UsersModule, PassportModule, JwtModule.register({
            secret: jwtConstants.secret, 
            signOptions: { expiresIn: '24h'},
        }),
    ],
    providers: [Bcrypt, LocalStrategy, AuthService, JwtStrategy],
    controllers: [AuthController],
    exports: [Bcrypt],
})

export class AuthModule {}