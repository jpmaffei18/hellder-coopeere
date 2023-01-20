import { UseGuards, HttpCode, Controller, Get, Post, Body, Patch, Put, Param, Delete } from '@nestjs/common';
import { UsersService } from './users.service';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { HttpStatus } from '@nestjs/common/enums';
import { User } from './entities/user.entity';
import { JwtAuthGuard } from 'src/auth/guard/jwt-auth.guard';

@Controller('users')
export class UsersController {
  constructor(private readonly usersService: UsersService) {}

  @HttpCode(HttpStatus.CREATED)
  @Post('/cadastrar')
  async create(@Body() username: User): Promise<User> {
    return this.usersService.create(username);
  }

  
  @UseGuards(JwtAuthGuard)
  @Get('/all')
  @HttpCode(HttpStatus.OK)
  findAll():Promise<User[]> {
    return this.usersService.findAll();
  }

  @Get(':id')
  findById(@Param('id') id: number) {
    return this.usersService.findById(id);
  }

  @UseGuards(JwtAuthGuard)
  @Patch('/atualizar')
  @HttpCode(HttpStatus.OK)
  async update(@Body() username:User, id: User): Promise<User> {
    return this.usersService.update(username, id);
  }

  @Delete(':id')
  remove(@Param('id') id: string) {
    return this.usersService.remove(+id);
  }
}
