import { Entity, Column, PrimaryGeneratedColumn } from 'typeorm';

@Entity()
export class PersonModel {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ length: 120 })
  name: string;

  @Column({ length: 120 })
  s_name: string;

  @Column()
  bday: Date;

  @Column()
  genre: string;

  @Column()
  cpfcnpj: number;

  @Column()
  phonenumber: number;

  @Column()
  cep: number;

  @Column()
  address: string;

  @Column()
  city: string;
  
  @Column()
  state: string;



  @Column({ length: 255 })
  email: string;

  @Column({ length: 100 })
  usuario: string;

  @Column({ length: 255 })
  senha: string;


}
