import React, {useState} from 'react';

import {Form,Button} from 'react-bootstrap';

import { Typeahead } from 'react-bootstrap-typeahead';
import Col from 'react-bootstrap/esm/Col';
import Container from 'react-bootstrap/esm/Container';
import Row from 'react-bootstrap/esm/Row';
import FormContainer from '../../components/FormContainer';
import EstadosDoBrasil from '../../components/EstadosDoBrasil';
import Logo from '../../assets/cooperecropped.png';

import { useNavigate } from 'react-router-dom';
import axios from 'axios';

export default function SignUp () {

    let navigate = useNavigate();
    const handleSubmit = async (event) => {
      event.preventDefault();
      const data = new FormData(event.currentTarget);
      const formm = {
        fullname : data.get('fname') +' '+ data.get('lname'),
        email: data.get('email'),
        password: data.get('password')
      };
      await axios.post("http://localhost:3002/api/v1/user/signup", formm); 
      navigate('/')  

  const [form, setForm] = useState({}) 
  const [errors, setErrors] = useState({})
  const calcAge = (dateString: any) => {
    const today = new Date()
    const birthDate = new Date(dateString)
    let age = today.getFullYear() - birthDate.getFullYear()
    const m = today.getMonth() - birthDate.getMonth()
    if (m < 0 || (m === 0  && today.getDate() < birthDate.getDate())){
        age--
    }
    return age
  }


  const setField = (field: any, value: any) => {
    setForm({
        ...form,
        [field]:value,
    })

    if(!!errors[field])
    setErrors({
        ...errors,
        [field]:null
    })
    

  }

  const validateForm = () => {
    const { 
        bdate, 
        genero, 
        formfirstname, 
        formsecondname, 
        cpfcnpj, 
        formemail, 
        formsenha, 
        formsenhaconf, 
        CEP, 
        fulladdress, 
        city, 
        estados
    } = form as {
        bdate: string;
        genero: string;
        formfirstname: string;
        formsecondname: string;
        cpfcnpj: string;
        formemail: string;
        formsenha: string;
        formsenhaconf: string;
        CEP: string;
        fulladdress: string;
        city: string;
        estados: string;
      };

    const newErrors = { bdate, genero, formfirstname, formsecondname, cpfcnpj, formemail, formsenha, formsenhaconf, CEP, fulladdress, city, estados }


    if(!formfirstname || formfirstname === '') newErrors.formfirstname = 'Você precisa inserir seu nome'

    if(!formsecondname || formsecondname === '') newErrors.formsecondname = 'Você precisa inserir seu sobrenome'

    
    if(!bdate || bdate === '') newErrors.bdate = 'Você precisa inserir sua data de nascimento pra continuar'
    else if (calcAge(bdate) < 18 )
        newErrors.bdate = 'Para continuar, você precisa ter 18 anos ou acima'


    if(!genero || genero === 'Selecionar Gênero') newErrors.genero = 'Escolha uma opção'

    if(!cpfcnpj || cpfcnpj === '') newErrors.cpfcnpj = 'Você precisa digitar seu CPF ou CNPJ'
    
    if(!formemail || formemail === '') newErrors.formemail = 'Você precisa digitar seu email'

    if(!formsenha || formsenha === '') newErrors.formsenha = 'Você precisa digitar uma senha'

    if(!formsenhaconf || formsenhaconf === '') newErrors.formsenhaconf = 'Você precisa confirmar sua senha'
    
    if(!CEP || CEP === '') newErrors.CEP = 'Você precisa digitar um CEP'
    
    if(!fulladdress || fulladdress === '') newErrors.fulladdress = 'Você precisa digitar seu endereço'

    if(!city || city  === '') newErrors.city = 'Você precisa confirmar sua cidade'

    if(!estados || estados  === 'Qual é o seu Estado?') newErrors.estados = 'Você precisa confirmar sua cidade'
    
    return newErrors    

  }

  const handleSubmit = (e: any) => {
    e.preventDefault()

    const formErrors = validateForm()
    if(Object.keys(formErrors).length > 0){
        setErrors(formErrors)
    }else {
        console.log("formulário enviado com sucesso")
        console.log(form)
    }
 
  }

  return (
    <FormContainer>
    <Container fluid >
        <Row className="justify-content-md-center">
            <Col xs lg="10">
            <br/>
            <br/>
            <br/>
                <Form className="row mx-auto">
                    <img src={Logo} alt='logo'
                    
                    style={{
                        maxWidth: "150px", padding: "13px"
                    }}
                    
                    />

                    <br/>
                    <br/>
                    <Form.Label style={{ fontSize: "30px"}}><strong>Realize o cadastro <br/>e torne-se um Coopeerado.</strong></Form.Label>
                    <hr/>
                    <br/>
                    <Form.Label  style={{ fontSize: "25px"}}><strong>Dados Pessoais</strong></Form.Label>

                    <Form.Group className="mb-3" controlId="formfirstname">
                    <Form.Label>Nome</Form.Label>
                        <Form.Control 
                            type="text" 
                            placeholder="Entre com seu primeiro nome"
                            value={form.formfirstname}
                            onChange={(e) => setField('formfirstname', e.target.value)}
                            isInvalid={!!errors.formfirstname}
                            
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.formfirstname}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formsecondname">
                    <Form.Label>Sobrenome Completo</Form.Label>
                        <Form.Control 
                            type="text" 
                            placeholder="Entre com seu sobrenome completo"
                            value={form.formsecondname}
                            onChange={(e) => setField('formsecondname', e.target.value)}
                            isInvalid={!!errors.formsecondname}
                            
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.formsecondname}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group  className="mb-3" controlId='bdate'>
                        <Form.Label>Data de Nascimento</Form.Label>
                        <Form.Control
                                type='date'
                                placeholder='Insira sua data de nascimento'
                                value={form.bdate}
                                onChange={(e: React.ChangeEvent<HTMLInputElement>) => setField('bdate', e.target.value)}
                                isInvalid={!!errors.bdate}
>

                        </Form.Control>
                        <Form.Control.Feedback type='invalid'>{errors.bdate}</Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId='genero'>
                        <Form.Label>
                            Gênero
                        </Form.Label>
                        <Form.Select 
                            value={form.genero}
                            placeholder='Qual é o seu gênero?'
                            onChange={(e) => setField('genero', e.target.value)}
                            isInvalid={!!errors.genero}
                            >
                            <option>Selecionar Gênero</option>
                            <option value='M'>Masculino</option>
                            <option value='F'>Feminino</option>
                            <option value='O'>Outros...</option>

                        </Form.Select>
                        <Form.Control.Feedback type='invalid'>
                            {errors.genero}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="cpfcnpj">
                    <Form.Label>CPF/CNPJ</Form.Label>
                        <Form.Control 
                            type="text" 
                            placeholder="Entre com seu CPF ou CNPJ completo"
                            value={form.cpfcnpj}
                            onChange={(e) => setField('cpfcnpj', e.target.value)}
                            isInvalid={!!errors.cpfcnpj}
                            
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.cpfcnpj}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="telefone">
                    <Form.Label>Telefone Celular (WhatsApp) </Form.Label>
                        <Form.Control 
                            type="text" 
                            placeholder="Entre com seu telefone com WhatsApp" 
                            value={form.telefone}
                            onChange={(e) => setField('telefone', e.target.value)}
                            isInvalid={!!errors.telefone}
                            
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.telefone}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formemail">
                        <Form.Label>E-Mail</Form.Label>
                        <Form.Control 
                            type="email" 
                            placeholder="Entre com seu email" 
                            value={form.formemail}
                            onChange={(e) => setField('formemail', e.target.value)}
                            isInvalid={!!errors.formemail}
                            
                            />
                        <Form.Text className="text-muted">Nunca compartiharemos suas informações com ninguém.</Form.Text>
                        <Form.Control.Feedback type='invalid'>
                            {errors.formemail}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formsenha">
                        <Form.Label>Escolha Uma Senha</Form.Label>
                        <Form.Control 
                            type="password" 
                            placeholder="Entre com sua senha" 
                            value={form.formsenha}
                            onChange={(e) => setField('formsenha', e.target.value)}
                            isInvalid={!!errors.formsenha}
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.formsenha}
                        </Form.Control.Feedback>
                    </Form.Group>
                   
                    <Form.Group className="mb-3" controlId="formsenhaconf">
                        <Form.Label>Confirme a Senha Escolhida</Form.Label>
                        <Form.Control 
                                type="password" 
                                placeholder="Repita sua senha"
                                value={form.formsenhaconf}
                                onChange={(e) => setField('formsenhaconf', e.target.value)}
                                isInvalid={!!errors.formsenhaconf}
                                />
                        <Form.Control.Feedback type='invalid'>
                            {errors.formsenhaconf}
                        </Form.Control.Feedback>
                    </Form.Group>
                <br/>
                <hr/>
                <br/>

                <Form.Label className="" style={{ fontSize: "25px"}}><strong>Endereço</strong></Form.Label>

                <Form.Group className="mb-3" controlId="CEP">
                    <Form.Label>CEP</Form.Label>
                        <Form.Control 
                        
                            type="text" 
                            placeholder="Qual é o seu CEP?" 
                            value={form.CEP}
                            onChange={(e) => setField('CEP', e.target.value)}
                            isInvalid={!!errors.CEP}
                            
                            />
                        <Form.Text className="text-muted">O mesmo da sua conta de energia.</Form.Text>
                        <Form.Control.Feedback type='invalid'>
                            {errors.CEP}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="fulladdress">
                    <Form.Label>Endereço com Número</Form.Label>
                        <Form.Control 
                            type="text" 
                            placeholder="Qual é o seu endereço completo?" 
                            value={form.fulladdress}
                            onChange={(e) => setField('fulladdress', e.target.value)}
                            isInvalid={!!errors.fulladdress}
                            
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.fulladdress}
                        </Form.Control.Feedback>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="city">
                    <Form.Label>Cidade</Form.Label>
                        <Form.Control 
                            type="text" 
                            placeholder="Qual é a sua cidade?" 
                            value={form.city}
                            onChange={(e) => setField('city', e.target.value)}
                            isInvalid={!!errors.city}
                            
                            />
                        <Form.Control.Feedback type='invalid'>
                            {errors.city}
                        </Form.Control.Feedback>
                    </Form.Group>

                <Form.Group controlId='estados'>
                <Form.Label className='mb-3'>Estado</Form.Label>
                
                <Typeahead 
                id='estados'
                name='estados'
                onChange={(selected) => {
                    console.log(selected)
                    console.log('get value out', selected[0])
                    setField('estados', selected && selected[0] )
                }}
                className={!!errors.estados && 'red-border'}
                inputProps={{ required: true }}
                placeholder='Qual é o seu Estado?'
                options={EstadosDoBrasil}
             
                />
                   
                </Form.Group>
                    <br/>
                    <br/>
              

            <Form.Group controlId='subbutton'>
                    <Button variant="primary" onClick={handleSubmit} type="submit" className='my-2'>Enviar</Button>
            </Form.Group>
    </Form>

            <br/>
            <br/>
            <br/>
    </Col>
    </Row>
    </Container>
    </FormContainer>
    
  );
}

}