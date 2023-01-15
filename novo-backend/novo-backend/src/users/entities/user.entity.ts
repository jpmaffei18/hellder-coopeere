import { Prop, Schema, SchemaFactory } from '@nestjs/mongoose';
import { Document } from 'mongoose';

export type UserDocument = User & Document;

@Schema()
export class User {

@Prop({required:true})
name: string;

@Prop({required:true})
secondname: string;

@Prop({required:true})
bday: Date;

@Prop({required:true})
genre: string;

@Prop({required:true})
cpfcnpj: number;

@Prop({required:true})
phonenumber: number;

@Prop({required:true})
cep: number;

@Prop({required:true})
address: string;

@Prop({required:true})
city: string;

@Prop({required:true})
state: string;

@Prop({required:true, unique:true, lowercase:true})
email: string;
    
  @Prop({required:true})
  _username: string;
 
  @Prop({required:true})
  _password: string;
}

export const UserSchema = SchemaFactory.createForClass(User);
