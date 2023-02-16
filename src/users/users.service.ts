import { Injectable, Inject, HttpException, HttpStatus } from '@nestjs/common';

import { Repository } from 'typeorm';
import { User } from './entities/user.entity';
import { Bcrypt } from 'src/auth/bcrypt/bcrypt';
import { UpdateUserDto } from './dto/update-user.dto';

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
  async findById(id: number): Promise<User> {
    let username = await this.usersRepository.findOne({ 
      where: {
        id 
      }
    
    });

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

/*
  async update(username: User, id: User): Promise<User> {

    let updateUser: User = await this.findById(username.id)
    let searchUser = await this.findByUsername(username.username);
    
    if(!updateUser)
        throw new HttpException('Usuário não encontrado!', HttpStatus.NOT_FOUND);

    if(searchUser && searchUser.id !== username.id)
        throw new HttpException('O Usuário (e-mail) já existe', HttpStatus.BAD_REQUEST);

    username.password = await this.bcrypt.cryptographPasswords(username.password)
    return await this.usersRepository.save(username);
  }
*/

async update(id: number, data: Partial<UpdateUserDto>) {
  await this.usersRepository.update({id}, data)
  return await this.usersRepository.findOne;
}


  //EXCLUSÃO DE UM USUÁRIO
  async destroy(id: number) {


    await this.usersRepository.delete({ id })  ;
    return { deleted: true}
      }
}
