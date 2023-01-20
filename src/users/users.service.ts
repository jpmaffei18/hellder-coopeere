import { Injectable, Inject, HttpException, HttpStatus } from '@nestjs/common';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { Repository } from 'typeorm';
import { User } from './entities/user.entity';
import { Bcrypt } from 'src/auth/bcrypt/bcrypt';

@Injectable()
export class UsersService {

  constructor(
    @Inject('USER_REPOSITORY')

    private usersRepository: Repository<User>,
    private bcrypt: Bcrypt
  ) {}

  //CRIAÇÃO DE NOVOS USUÁRIOS
  async create(username: User): Promise<User> {

    let searchUser = await this.findByUsername(username.username);

    if(!searchUser){
      username.password = await this.bcrypt.cryptographPasswords(username.password)
      
      return this.usersRepository.save(username);
    }

    throw new HttpException("O Usuario ja existe!", HttpStatus.BAD_REQUEST);
   
  }


  //EXIBIÇÃO DE TODOS OS USUÁRIOS NA TELA
  async findAll(): Promise<User[]> {
    return this.usersRepository.find();
  }

  //EXIBIÇÃO DE UM USUÁRIO NA TELA
  async findOne(id: number): Promise<User> {
    let username = await this.usersRepository.findOneBy({ id:id });

    if(!username)
      throw new HttpException('Usuário não encontrado', HttpStatus.NOT_FOUND);

      return username;
  }

  async findByUsername(username: string): Promise<User | undefined> {
    return await this.usersRepository.findOne({
        where: {
            username: username
        }
    })
}


  //ATUALIZAÇÃO DE USUÁRIO
  async update(username: User): Promise<User> {

    let updateUser: User = await this.findOne(username.id)
    let searchUser = await this.findByUsername(username.username);
    
    if(!updateUser)
        throw new HttpException('Usuário não encontrado!', HttpStatus.NOT_FOUND);

    if(searchUser && searchUser.id !== username.id)
        throw new HttpException('O Usuário (e-mail) já existe', HttpStatus.BAD_REQUEST);

    username.password = await this.bcrypt.cryptographPasswords(username.password)
    return this.usersRepository.save(username);
  }

  //EXCLUSÃO DE UM USUÁRIO
  remove(id: number) {
    return this.usersRepository.delete(id);
  }
}
