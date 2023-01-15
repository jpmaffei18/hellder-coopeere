import { Injectable, HttpException, HttpStatus } from '@nestjs/common';
import { CreateUserDto } from './dto/create-user.dto';
import { UpdateUserDto } from './dto/update-user.dto';
import { User, UserDocument } from './entities/user.entity';
import { Model } from 'mongoose';
import { InjectModel } from '@nestjs/mongoose/dist';
import * as bcrypt from 'bcrypt';
import { JwtService } from '@nestjs/jwt';

@Injectable()
export class UsersService {

  constructor(@InjectModel(User.name) private userModel: Model<UserDocument>) {}

  async signup(user: User): Promise<User> {
    const salt = await bcrypt.genSalt();
    const hash = await bcrypt.hash(user._password, salt);
    const reqBody = {
        username: user._username,
        email: user.email,
        password: hash
    }
    const newUser = new this.userModel(reqBody);
    return newUser.save();
}

async signin(user: User, jwt: JwtService): Promise<any> {
  const foundUser = await this.userModel.findOne({ email: user.email }).exec();
  if (foundUser) {
      const { _password } = foundUser;
      if (bcrypt.compare(user._password, _password)) {
          const payload = { email: user.email };
          return {
              token: jwt.sign(payload),
          };
      }
      return new HttpException('Incorrect username or password', HttpStatus.UNAUTHORIZED)
  }
  return new HttpException('Incorrect username or password', HttpStatus.UNAUTHORIZED)
}

async getOne(email): Promise<User> {
  return await this.userModel.findOne({ email }).exec();
}

  create(createUserDto: CreateUserDto) {
    const user = new this.userModel(createUserDto);
    return user.save();
  }

  findAll() {
    return this.userModel.find();
  }

  findOne(id: string) {
   return this.userModel.findById(id);
  }

  update(id: string, updateUserDto: UpdateUserDto) {
    return this.userModel.findByIdAndUpdate(
      {
        _id: id,
      },
      {
        $set : updateUserDto,
      },
      {
        new : true,
      },
    )
  }

  remove(id: string) {
   return this.userModel
   .deleteOne({
    _id: id,
   })
   .exec();
  }
}
