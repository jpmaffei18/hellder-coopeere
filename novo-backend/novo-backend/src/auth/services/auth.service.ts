import { HttpException, HttpStatus, Injectable } from '@nestjs/common';
import { JwtService } from '@nestjs/jwt';
import { UsersService } from 'src/users/users.service';
import { Bcrypt } from '../bcrypt/bcrypt';

@Injectable()
export class AuthService {
  constructor(
    private usersService: UsersService,
    private jwtService: JwtService,
    private bcrypt: Bcrypt
  ) { }

  async validateUser(username: string, password: string): Promise<any> {

    const buscaUsuario = await this.usersService.findOne(username)

    if (!buscaUsuario)
        throw new HttpException('Usuário não encontrado!', HttpStatus.NOT_FOUND);
      
    const match = await this.bcrypt.compararSenhas(buscaUsuario._password, password)

    if (buscaUsuario && match) {
      const { _password, ...result } = buscaUsuario;
      return result;
    }
    return null;
  }

  async login(userLogin: any) {

    const payload = { username: userLogin._username, sub: "coopeere" };

    return {
      _username: userLogin._username,
      token: `Bearer ${this.jwtService.sign(payload)}`,
    };
    
  }

}