
import { Entity, Column, PrimaryGeneratedColumn } from 'typeorm';

// PADRÃO DE CARACTERÍSTICAS, QUE É DE ONDE NASCEM AS TABELAS DO BANCO DE DADOS

@Entity()
export class User {
    @PrimaryGeneratedColumn()
    id: number;

    @Column({length: 100})
    name: string;
    
    @Column({length: 100})
    secondname: string;

    @Column()
    b_day: string;

    @Column({length: 100})
    genre: string;

    @Column()
    phonenumber: number;

    @Column()
    cep: number;

    @Column({length: 100})
    address: string;

    @Column({length: 100})
    city: string;
    
    @Column({length: 100})
    state: string;

        @Column({length: 100})
        email: string;

        @Column({length: 100})
        username: string;

        @Column({length: 100})
        password: string;
}

