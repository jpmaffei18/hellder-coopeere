import { Controller, Get, Post, Body, Patch, Param, Delete, UseGuards, HttpStatus, Res } from '@nestjs/common';
import { UsersService } from './users.service';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { JwtAuthGuard } from 'src/auth/guard/jwt-auth.guard';
import { JwtService } from '@nestjs/jwt';
import { User } from './entities/user.entity';

@Controller('users')
export class UsersController {
  constructor(private readonly usersService: UsersService, private jwtService: JwtService
    ) {}


    @Post('/signup')
    async Signup(@Res() response, @Body() user: User) {
        const newUSer = await this.usersService.signup(user);
        return response.status(HttpStatus.CREATED).json({
            newUSer
        })
    }
    @Post('/signin')
    async SignIn(@Res() response, @Body() user: User) {
        const token = await this.usersService.signin(user, this.jwtService);
        return response.status(HttpStatus.OK).json(token)
    }
  

  
  @Post()
  create(@Body() createUserDto: CreateUserDto) {
    return this.usersService.create(createUserDto);
  }

  @UseGuards(JwtAuthGuard)
  @Get()
  findAll() {
    return this.usersService.findAll();
  }

  @UseGuards(JwtAuthGuard)
  @Get(':id')
  findOne(@Param('id') id: string) {
    return this.usersService.findOne(id);
  }

  @UseGuards(JwtAuthGuard)
  @Patch(':id')
  update(@Param('id') id: string, @Body() updateUserDto: UpdateUserDto) {
    return this.usersService.update(id, updateUserDto);
  }

  @Delete(':id')
  remove(@Param('id') id: string) {
    return this.usersService.remove(id);
  }
}
