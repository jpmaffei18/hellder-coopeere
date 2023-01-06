import Button from 'react-bootstrap/Button';
import Container from 'react-bootstrap/Container';
import Form from 'react-bootstrap/Form';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import Logo from '../../assets/cooperecropped.png';

import  {
    BrowserRouter as Router,
    Routes,
    Route,
    Link
  } from "react-router-dom"
import Pessoais from './Tabs/Pessoais';
import Prodist from './Tabs/Prodist';
import Triagem from './Tabs/Triagem';
import Planos from './Tabs/Planos';
import Convite from './Tabs/Convite';
import Faq from './Tabs/Faq';
import Regulamento from './Tabs/Regulamento';

const Painel = () => {
    return (
        <Router>
            <Navbar bg="light" expand="lg">
              <Container fluid>
               <img src={Logo} style={{ paddingLeft: "50px", paddingRight: "50px", paddingTop: "25px", paddingBottom: "25px"}}/>
                <Navbar.Toggle aria-controls="navbarScroll" />
                <Navbar.Collapse id="navbarScroll">
                  <Nav className="me-auto my-2 my-lg-0" >
                    <Nav.Link as={Link} to={"/bio"}>Bio</Nav.Link>
                    <Nav.Link as={Link} to={"/triagem"}>Triagem</Nav.Link>
                    <Nav.Link as={Link} to={"/prodist"}>PRODIST</Nav.Link>
                    <Nav.Link as={Link} to={"/planos"}>Planos</Nav.Link>
                    <Nav.Link as={Link} to={"/convite"}>Convite</Nav.Link>
                    <Nav.Link as={Link} to={"/regulamento"}>Regulamento</Nav.Link>
                    <Nav.Link as={Link} to={"/faq"}>FAQ</Nav.Link>

               
                 
                  </Nav>
                  <Form className="d-flex">
                
                    <Button variant="outline-danger">Sair</Button>
                  </Form>
                </Navbar.Collapse>
              </Container>
            </Navbar>
            <div>
                <Routes>

                <Route path="/bio" element={<Pessoais/>}/>
                <Route path="/triagem" element={<Triagem/>}/>
                <Route path="/prodist" element={<Prodist/>}/>
                <Route path="/planos" element={<Planos/>}/>
                <Route path="/convite" element={<Convite/>}/>
                <Route path="/regulamento" element={<Regulamento/>}/>
                <Route path="/faq" element={<Faq/>}/>                  
                    
                
                </Routes>
            </div>
        </Router>
        

/*
        
  <div className="container-fluid container-step-menu">
        <ul className="nav nav-tabs">
      
        <li className="nav-item">
          <a className="nav-link active" aria-current="page" href="./Tabs/Pessoais">Bio</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Regras</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Triagem</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Prodist</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Planos</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Sorteio</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Regulamento</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Convite</a>
        </li>
      </ul>

      </div>

      */
    )
}

export default Painel