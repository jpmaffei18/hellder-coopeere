import { HttpException, HttpStatus } from '@nestjs/common';
import { Injectable } from '@nestjs/common';
import { UsersService } from '../users/users.service';
import { JwtService } from '@nestjs/jwt';
import { Bcrypt } from './bcrypt/bcrypt';

@Injectable()
export class AuthService {
  constructor(
    private usersService: UsersService,
    private jwtService: JwtService,
    private bcrypt: Bcrypt
  ) {}

  async validateUser(username: string, password: string): Promise<any> {
    const searchUser = await this.usersService.findByUsername(username);
   
if(!searchUser)
    throw new HttpException('Usuário não encontrado', HttpStatus.NOT_FOUND);


    const match = await this.bcrypt.comparePasswords(searchUser.password, password)


    if (searchUser && match) {
        const { password, ...result} = searchUser;
        return result;
    }
    return null;
}

  async login(userLogin: any) {
    const payload = { username: userLogin.username, sub: "crudcoopeere" };
    return {
            username: userLogin.username,
            token:` Bearer ${this.jwtService.sign(payload)}`,
    };
  }
}
