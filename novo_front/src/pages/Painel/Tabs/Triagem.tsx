import React from 'react';
import { Form, FormGroup, Label, Input, FormText, Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.css';
import { Container } from 'react-bootstrap';

const Triagem: React.FC = () => {
  return (
    <Container style={{ paddingTop: "25px" }}>
    <div className="tab">
      <fieldset className="fieldset">
        <h3 className="tab-title">Triagem</h3>
        <p>Escolha a sua distribuidora (de acordo com sua conta de luz):</p>
        <FormGroup className="operadora_field mb-5">

          <div className='row-of-cards'>
          <div className='cards-radio-triagem'>
          <FormGroup check inline>
            <Label check>
              <Input type="radio" name="idoperadora" value="1" id="operadora1" defaultChecked />{' '}
              Enel-RJ
            </Label>
          </FormGroup>
          </div>
          <div className='cards-radio-triagem'>
          <FormGroup check inline>
            <Label check>
              <Input type="radio" name="idoperadora" value="2" id="operadora2" />{' '}
              Light-RJ
            </Label>
          </FormGroup>
          </div>
          <div className='cards-radio-triagem'>
          <FormGroup check inline>
            <Label check>
              <Input type="radio" name="idoperadora" value="3" id="operadora3" />{' '}
              Enel-SP
            </Label>
          </FormGroup>
          </div>
          </div>
        </FormGroup>
     

        <div className='more-options-triagem'>
        <FormGroup check row>
          <Label check className="col-auto">Tenho uma conta da concessionária selecionada <strong> em meu nome. </strong> (Preencha o formulário PRODIST ANEEL com os dados desta conta)
            <Input type="radio" name="eh_titular" value="true" id="titular" defaultChecked />
          </Label>
          <Label for="titular" id="mensagem_triagem_titular" className="col">
          </Label>
        </FormGroup>
        <FormGroup check row>
          <Label check className="col-auto"> Não sou titular de uma conta na concessionária acima, mas me cadastrarei com o Link convite que me foi enviado ou o farei sem convite por livre e espontânea vontade para apoiar a cooperativa. (você será um Cooperado Apoiador).
            <Input type="radio" name="eh_titular" value="false" id="ntitular" />
          </Label>
          <Label for="ntitular" id="mensagem_triagem_ntitular" className="col">
          </Label>
        </FormGroup>
        </div>
      </fieldset>
    </div>
    </Container>
  );
};

export default Triagem;
