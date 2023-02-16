declare module namespace {

    export interface CreditCard {
        holderName: string;
        number: string;
        expiryMonth: string;
        expiryYear: string;
        ccv: string;
    }

    export interface CreditCardHolderInfo {
        name: string;
        email: string;
        cpfCnpj: string;
        postalCode: string;
        addressNumber: string;
        addressComplement?: any;
        phone: string;
        mobilePhone: string;
    }

    export interface RootObject {
        customer: string;
        billingType: string;
        dueDate: string;
        value: number;
        description: string;
        externalReference: string;
        creditCard: CreditCard;
        creditCardHolderInfo: CreditCardHolderInfo;
        creditCardToken: string;
    }

}

