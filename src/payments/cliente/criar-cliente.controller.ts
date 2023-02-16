import { Body, Controller, HttpCode, Post } from "@nestjs/common";
import { CriarClienteService } from "./criar-cliente.service";
import { CriarCliente } from "./criar-cliente.entity"
import { HttpStatus } from "@nestjs/common/enums";

    @Controller('criarcliente')
    export class CriarClienteController {
        constructor(private readonly criarClienteService: CriarClienteService) {}

  @HttpCode(HttpStatus.CREATED)
  @Post('cadastrar')
  async create(@Body() id: CriarCliente): Promise<CriarCliente> {
    return this.criarClienteService.create(id);
  }

    }

  

