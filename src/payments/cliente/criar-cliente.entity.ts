import { Entity, Column, PrimaryGeneratedColumn } from 'typeorm';

@Entity()
export class CriarCliente {
  @PrimaryGeneratedColumn()
    id: number
    
@Column()
name: string;

@Column()
customerId: string;

@Column()
cpfCnpj: string;

@Column()
email: string;

@Column()
phone: number;

@Column()
mobilePhone: number;

@Column()
address: string;

@Column()
addressNumber: number;

@Column()
complement: string;

@Column()
province: string;

@Column()
postalCode: number;

@Column()
externalReference: string;

@Column()
notificationDisabled: boolean;

@Column()
additionalEmails: string;

@Column()
municipalInscription: string;

@Column()
stateInscription: string;

@Column()
observations: string;

@Column()
groupName: string;

}