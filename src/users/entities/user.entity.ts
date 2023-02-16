import { IsEmail, IsNotEmpty, MinLength } from "class-validator"
import { Entity, Column, PrimaryGeneratedColumn } from 'typeorm';
import { ApiProperty } from "@nestjs/swagger"

// PADRÃO DE CARACTERÍSTICAS, QUE É DE ONDE NASCEM AS TABELAS DO BANCO DE DADOS

@Entity()

export class User {
     
    
    @ApiProperty()
    @PrimaryGeneratedColumn()
    public id: number;

    @Column({length: 100})
    @ApiProperty()
    public externalReference: string;
    

    
     
    @ApiProperty()
    @Column({length: 100})
    public name: string;
    
    
    @Column({length: 100})
    @ApiProperty()
    public cpfCnpj: string;

     
    @Column()
    @ApiProperty()
    public b_day: string;

     
    @Column({length: 100})
    @ApiProperty()
    public genre: string;

     
    @Column()
    @ApiProperty()
    public phone: number;

    @Column()
    @ApiProperty()
    public mobilePhone: number;

     
    @Column()
    @ApiProperty()
    public postalCode: number;

     
    @Column({length: 100})
    @ApiProperty()
    public address: string;

    
    @Column()
    @ApiProperty()
    public addressNumber: number;


    @Column({length: 100})
    @ApiProperty()
    public complement: string;


    @Column({length: 100})
    @ApiProperty()
    public province: string;

        
    @Column({length: 100})
    @ApiProperty()
    public state: string;

    

    @Column({length: 100})
    @ApiProperty()
    public municipalInscription: string;

    @Column({length: 100})
    @ApiProperty()
    public stateInscription: string;

    @Column({length: 100})
    @ApiProperty()
    public observations: string;

    @Column({length: 100})
    @ApiProperty()
    public groupName: string;









    

    
    @Column()
    @ApiProperty()
    public notificationDisabled: boolean;

         
        @Column({length: 100})
        @ApiProperty()
        public email: string;

         
        @Column({length: 100})
        @ApiProperty()
        public username: string;

        
         
         
        @Column({length: 100})
        @ApiProperty()
        public password: string;
}

