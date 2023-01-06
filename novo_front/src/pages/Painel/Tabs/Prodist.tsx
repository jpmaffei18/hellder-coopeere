import { Container, Dropdown, Row } from 'react-bootstrap';
import "./Tabs.css"
import Form from 'react-bootstrap/Form';

function Prodist() {
  return (
    <Container className='' style={{ paddingTop: "15px"}}>

    <h3>Formulário PRODIST</h3>
    <h5>(deve-se preencher e salvar a etapa TRIAGEM, antes de preencher o formulário Prodist)</h5>

    <hr/>

        <div className="m-3">
            <label>Upload da Conta de Luz: </label>
            <br/>
            <label className='little-leg'>Últimos 3 meses</label>
            <br/>
            <input className="d-none" type="file" />
            <button className="btn btn-outline-primary">Enviar Arquivo</button>
       </div>

         <Row xs={1} md={1} lg={9}>

         
       
    <Form>
      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>Código UC / Número do Cliente</Form.Label>
      
        <Form.Control type="number" placeholder="Insira o número" />


      </Form.Group>

      <Form.Group className="mb-3" controlId="formBasicPassword">
        <Form.Label>Classe UC</Form.Label>
        <Form.Control type="text" placeholder="Insira o tipo de unidade" />
        <Form.Text className="text-muted">
          Unidade consumidora.
        </Form.Text>
      </Form.Group>
     
      <hr/>

      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>Cota que deseja comprar mensalmente</Form.Label>      
        <Form.Control type="number" placeholder="Insira o número" />
        <Form.Text className="text-muted">
        Preço estimado em 50% menor do que a operadora
        </Form.Text>


      </Form.Group>

      <Form.Group className="mb-3" controlId="formBasicPassword">
        <Form.Label>Tensão de Atendimento (V)</Form.Label>
        <Form.Control type="text" placeholder="Insira a tensão" />
       
      </Form.Group>


      <Form.Group className="mb-3" controlId="formBasicEmail">
        
      <Form.Label>Potência Instalada</Form.Label>
      <Form.Control
        type="text"
        placeholder="Disabled input"
        aria-label="Disabled input example"
        disabled
        readOnly
      />
              <Form.Text className="text-muted">
        Preço estimado em 50% menor do que a operadora
        </Form.Text>
        </Form.Group>

      <label>Tipo de Ramal</label>
        <br/>
       

        <Form.Select aria-label="Default select example">
      <option>Escolha o tipo de Ramal
      </option>
      <option value="1">Aéreo</option>
      <option value="2">Subterrâneo</option>
    </Form.Select>
    <label className='little-leg'>A energia chega até você via postes ou debaixo da terra?</label>
        <br/>
<br/>

<label>Tipo de Conexão</label>
        <br/>
        

        <Form.Select aria-label="Default select example">
      <option>Escolha o tipo de conexão
      </option>
      <option value="1">Monofásica</option>
      <option value="2">Bifásica</option>
      <option value="3">Trifásica</option>
    </Form.Select>
    <label className='little-leg'>Esta informação tem em sua conta de energia.</label>
        <br/>

<hr/> 

<br/>

<Form.Group className="mb-3" controlId="formBasicEmail">
        
        <Form.Label>Potência Instalada gerada</Form.Label>
        <Form.Control
          type="text"
          placeholder="Disabled input"
          aria-label="Disabled input example"
          disabled
          readOnly
        />
           
          </Form.Group>
    

          <label>Tipo de Fonte de Geração</label>
        <br/>
        

        <Form.Select aria-label="Default select example">
      <option>Escolha o tipo de conexão
      </option>
      <option value="1">Hidráulica</option>
      <option value="2">Biomassa</option>
      <option value="3">Eólica</option>
      <option value="4">Solar</option>
      <option value="5">Coogeração Qualificada</option>
    </Form.Select>
    <label className='little-leg'>O padrão é Eólica.</label>
        <br/>

        <Form.Group className="mb-3" controlId="formBasicPassword">
        <Form.Label>Classe UC</Form.Label>
        <Form.Control type="text" placeholder="Insira o tipo de unidade" />
        <Form.Text className="text-muted">
          Unidade consumidora.
        </Form.Text>
      </Form.Group>
     
      <hr/>

      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>Cota que deseja comprar mensalmente</Form.Label>      
        <Form.Control type="number" placeholder="Insira o número" />
        <Form.Text className="text-muted">
        Preço estimado em 50% menor do que a operadora
        </Form.Text>


      </Form.Group><Form.Group className="mb-3" controlId="formBasicPassword">
        <Form.Label>Menor consumo</Form.Label>
        <Form.Control type="text" placeholder="Insira o número" />
        <Form.Text className="text-muted">
        Dos últimos 12 meses
        </Form.Text>
      </Form.Group>
     
      

      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>Maior consumo</Form.Label>      
        <Form.Control type="number" placeholder="Insira o número" />
        <Form.Text className="text-muted">
        Dos últimos 12 meses
        </Form.Text>


      </Form.Group>
    <div style={{  }}>
      <button className="btn btn-success">Enviar</button>
      <button className="btn btn-primary">Visualizar</button>
      <button className="btn btn-danger">Deletar</button>
    </div>
    
      <br/>
      <br/>
      <br/>

    </Form>

    </Row>
    </Container>
  );
}

export default Prodist;