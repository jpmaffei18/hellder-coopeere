import { Injectable, Inject, HttpException, HttpStatus } from '@nestjs/common';
import { Repository } from "typeorm";
import { CriarCliente } from './criar-cliente.entity';
import { CriarClienteDto } from './dto/criar-cliente.dto';

@Injectable()
export class CriarClienteService {

    constructor(
        @Inject('USER_REPOSITORY')
    
        private usersRepository: Repository<CriarCliente>,
        
      ) {}
    


    async create(data: CriarClienteDto) {
        // return this.createPostDto.create();
     
         const post = this.usersRepository.create(data);
         await this.usersRepository.save(data);
         return post;
     
       }
}