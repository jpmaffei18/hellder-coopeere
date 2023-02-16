import { UseGuards, HttpCode, Controller, Get, Post, Body, Patch, Put, Param, Delete } from '@nestjs/common';
import { UsersService } from './users.service';
import { ApiBearerAuth, ApiTags } from "@nestjs/swagger";
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { HttpStatus } from '@nestjs/common/enums';
import { User } from './entities/user.entity';
import { JwtAuthGuard } from 'src/auth/guard/jwt-auth.guard';

@ApiTags('User')
@Controller('users')
export class UsersController {
  constructor(private readonly usersService: UsersService) {}

  @HttpCode(HttpStatus.CREATED)
  @Post('cadastrar')
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
  async updateUser(@Param('id') id: number, @Body() data: Partial<CreateUserDto>) {
    await this.usersService.update(id, data);
    return {
      statusCode: HttpStatus.OK,
      message: 'post atualizado com sucesso',
    };
  }

  @Delete(':id')
  async deleteUser(@Param('id') id: number) {
    await this.usersService.destroy(id);
    return {
      statusCode: HttpStatus.OK,
      message: 'post appagado com sucessi',
    };
  }
}
