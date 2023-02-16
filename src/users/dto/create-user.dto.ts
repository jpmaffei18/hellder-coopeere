import { IsEmail, IsNotEmpty, MinLength } from "class-validator"


export class CreateUserDto {
   

    @IsNotEmpty()
    public name: string;

    @IsNotEmpty()
    public cpfCnpj: string;

    
    public externalReference: string;

    @IsNotEmpty()
    public b_day: string;

    @IsNotEmpty()
    public genre: string;

    @IsNotEmpty()
    public phone: number;

    @IsNotEmpty()
    public mobilePhone: number;


    @IsNotEmpty()
    public postalCode: number;

    @IsNotEmpty()
    public address: string;

    @IsNotEmpty()
    public addressNumber: number;

    @IsNotEmpty()
    public complement: string;

    @IsNotEmpty()
    public province: string;
    
    @IsNotEmpty()
    public state: string;



    @IsNotEmpty()
    public municipalInscription: string;

    @IsNotEmpty()
    public stateInscription: string;

    @IsNotEmpty()
    public observations: string;

    @IsNotEmpty()
    public groupName: string;

    public notificationDisabled: boolean;

        @IsEmail()
        public email: string;

        @IsNotEmpty()
        public username: string;

        
        @IsNotEmpty()
        @MinLength(8)
        public password: string;
}

