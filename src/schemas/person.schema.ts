import { IsString, IsInt, Min, MaxLength, IsEmail } from 'class-validator';

export class PersonSchema {
  @IsString()
  @MaxLength(120)
  name: string;

  @IsString()
  @MaxLength(120)
  s_name: string;

  @IsInt()
  @Min(1)
  bday: Date;


  @IsString()
  @MaxLength(120)
  genre: string;

  @IsInt()
  @MaxLength(15)
  cpfcnpj: number;

  @IsInt()
  @MaxLength(12)
  phonenumber: number;

  @IsInt()
  @MaxLength(9)
  cep: number;

  @IsString()
  @MaxLength(255)
  address: string;


  @IsString()
  @MaxLength(120)
  city: string;

  @IsString()
  @MaxLength(120)
  state: string;


  @IsString()
  @IsEmail()
  @MaxLength(255)
  email: string;

  @IsString()
  @MaxLength(255)
  usuario: string;

  @IsString()
  @MaxLength(255)
  senha: string;
}
