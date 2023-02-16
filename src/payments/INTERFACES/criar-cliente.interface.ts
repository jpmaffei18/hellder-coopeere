declare module namespace {

    export interface Name {
        type: string;
    }

    export interface CpfCnpj {
        type: string;
    }

    export interface Email {
        type: string;
    }

    export interface Phone {
        type: string;
    }

    export interface MobilePhone {
        type: string;
    }

    export interface Address {
        type: string;
    }

    export interface AddressNumber {
        type: string;
    }

    export interface Complement {
        type: string;
    }

    export interface Province {
        type: string;
    }

    export interface PostalCode {
        type: string;
    }

    export interface ExternalReference {
        type: string;
    }

    export interface NotificationDisabled {
        type: string;
    }

    export interface AdditionalEmails {
        type: string;
    }

    export interface MunicipalInscription {
        type: string;
    }

    export interface StateInscription {
        type: string;
    }

    export interface Observations {
        type: string;
    }

    export interface GroupName {
        type: string;
    }

    export interface Properties {
        name: Name;
        cpfCnpj: CpfCnpj;
        email: Email;
        phone: Phone;
        mobilePhone: MobilePhone;
        address: Address;
        addressNumber: AddressNumber;
        complement: Complement;
        province: Province;
        postalCode: PostalCode;
        externalReference: ExternalReference;
        notificationDisabled: NotificationDisabled;
        additionalEmails: AdditionalEmails;
        municipalInscription: MunicipalInscription;
        stateInscription: StateInscription;
        observations: Observations;
        groupName: GroupName;
    }

    export interface RootObject {
        $schema: string;
        type: string;
        properties: Properties;
        required: string[];
    }

}

