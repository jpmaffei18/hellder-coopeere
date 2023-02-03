import { IsEmail, IsNotEmpty, MinLength } from "class-validator"
import { Entity, Column, PrimaryGeneratedColumn } from 'typeorm';
import { ApiProperty } from "@nestjs/swagger"

// PADRÃO DE CARACTERÍSTICAS, QUE É DE ONDE NASCEM AS TABELAS DO BANCO DE DADOS

@Entity()

export class User {
    @IsNotEmpty()
    @ApiProperty()
    @PrimaryGeneratedColumn()
    public id: number;

    @IsNotEmpty()
    @ApiProperty()
    @Column({length: 100})
    public name: string;
    
    @IsNotEmpty()
    @Column({length: 100})
    @ApiProperty()
    public secondname: string;

    @IsNotEmpty()
    @Column()
    @ApiProperty()
    public b_day: string;

    @IsNotEmpty()
    @Column({length: 100})
    @ApiProperty()
    public genre: string;

    @IsNotEmpty()
    @Column()
    @ApiProperty()
    public phonenumber: number;

    @IsNotEmpty()
    @Column()
    @ApiProperty()
    public cep: number;

    @IsNotEmpty()
    @Column({length: 100})
    @ApiProperty()
    public address: string;

    @IsNotEmpty()
    @Column({length: 100})
    @ApiProperty()
    public city: string;
    
    @IsNotEmpty()
    @Column({length: 100})
    @ApiProperty()
    public state: string;

        @IsEmail()
        @Column({length: 100})
        @ApiProperty()
        public email: string;

        @IsNotEmpty()
        @Column({length: 100})
        @ApiProperty()
        public username: string;

        
        @IsNotEmpty()
        @MinLength(8)
        @Column({length: 100})
        @ApiProperty()
        public password: string;
}

