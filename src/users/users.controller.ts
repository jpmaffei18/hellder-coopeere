import { HttpCode, Controller, Get, Post, Body, Patch, Param, Delete } from '@nestjs/common';
import { UsersService } from './users.service';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { HttpStatus } from '@nestjs/common/enums';
import { User } from './entities/user.entity';

@Controller('users')
export class UsersController {
  constructor(private readonly usersService: UsersService) {}

  @HttpCode(HttpStatus.CREATED)
  @Post('/cadastrar')
  async create(@Body() username: User): Promise<User> {
    return this.usersService.create(username);
  }

  @Get('/all')
  @HttpCode(HttpStatus.OK)
  findAll():Promise<User[]> {
    return this.usersService.findAll();
  }

  @Get(':id')
  findOne(@Param('id') id: string) {
    return this.usersService.findOne(+id);
  }

  @Patch('/atualizar')
  @HttpCode(HttpStatus.OK)
  async update(@Body() username:User) {
    return this.usersService.update(username);
  }

  @Delete(':id')
  remove(@Param('id') id: string) {
    return this.usersService.remove(+id);
  }
}
