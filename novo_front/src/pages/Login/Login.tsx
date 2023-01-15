import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import Col from 'react-bootstrap/esm/Col';
import Container from 'react-bootstrap/esm/Container';
import Row from 'react-bootstrap/esm/Row';
import axios from 'axios';
import { useNavigate } from "react-router-dom";
import React from 'react';

function Login({setIsLoggedIn}: any ){
  const [errrorMessage, setErrorMessage] = React.useState('')
  let navigate = useNavigate();

  const handleSubmit = async (event: any) => {
    event.preventDefault();
    const formData = new FormData(event.currentTarget);
    const form = {
      email: formData.get('email'),
      password: formData.get('password')
    };
    const { data } = await axios.post("http://localhost:3002/api/v1/user/signin", form);
    if (data.status === parseInt('401')) {
      setErrorMessage(data.response)
    } else {
      localStorage.setItem('token', data.token);
      setIsLoggedIn(true)
      navigate('/video')
    }
  };

  return (
    <Container className="my-auto mx-auto align-items-md-center d-flex" fluid  style={{maxWidth: "500px", }}>
        <Row className="justify-content-md-center">

            <Col lg='10'>
              <h2>Seja Bem-vindo a COOPEERE. </h2>
              <br/>
              <h4>Entre para continuar.</h4>
              <br/>
            </Col>


            <Col xs lg="10">
                <Form className="row mx-auto">
                    <Form.Group className="mb-3" controlId="formBasicEmail">
                        <Form.Label>E-Mail</Form.Label>
                        <Form.Control type="email" placeholder="Entre com seu email" />
                        <Form.Text className="text-muted">Nunca compartiharemos suas informações com ninguém.</Form.Text>
                    </Form.Group>

                    <Form.Group className="mb-3" controlId="formBasicPassword">
                        <Form.Label>Senha</Form.Label>
                        <Form.Control type="password" placeholder="Entre com sua senha" />
                    </Form.Group>
                    <Form.Group className="mb-3" controlId="formBasicCheckbox">
                        <Form.Check type="checkbox" label="Lembrar minha senha" />
       
                    </Form.Group>
                    
      <Button variant="primary" type="submit">Entrar</Button>
      <br/>
      
      <h6>Ainda não tem uma conta?</h6>
      <Button variant="outline-primary" component="form" type="submit" onSubmit={handleSubmit} noValidate sx={{ mt: 1 }} >Cadastre-se</Button>
    </Form>
    </Col>
    </Row>

    <Row>
     
    </Row>

    </Container>
  );
}

export default Login;