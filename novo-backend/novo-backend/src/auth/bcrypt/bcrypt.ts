import { Injectable } from "@nestjs/common";
import * as bcrypt from "bcrypt";



@Injectable()

export class Bcrypt {
    async criptografarSenha(_password: string): Promise<string>{
        let saltos: number = 10;
        return await bcrypt.hash(_password, saltos);
    }

    async compararSenhas(senhaBanco: string, senhaDigitada: string): Promise<boolean>{

        return bcrypt.compareSync(senhaDigitada, senhaBanco )
    }
}