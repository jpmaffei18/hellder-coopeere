import { InjectRepository, Injectable } from "@nestjs/typeorm";
import { Bcrypt } from "src/auth/bcrypt";
import { PersonSchema } from "src/schemas/person.schema";
import { Repository } from "typeorm";

@Injectable()
export class PersonService {

    constructor(
        @InjectRepository(PersonSchema)
        private personRepository: Repository<PersonSchema>,
        private bcrypt: Bcrypt
    ) {}

}