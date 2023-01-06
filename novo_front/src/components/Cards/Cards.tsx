import { Button, Container, Row } from 'react-bootstrap';
import Card from 'react-bootstrap/Card';
import "./Cards.css"

function Cards() {
  return (
    <div>
    <Container>
    <Row xs={2} md={4} lg={10}>
    <div className='col' style={{ padding: "10px", gap: "10px" , margin: "10px"}}>
    <Card>
      <Card.Header style={{ fontWeight: "bold"   }}>Associado</Card.Header>
      <Card.Body>
        <blockquote className="blockquote mb-0 ">

            
          <p className='titulos'>
            {' '}
            Hellder Benjamin{' '}
          </p>
          <p className='titulos'>
            {' '}
            007.344.457-09{' '}
          </p>
          
        </blockquote>
      </Card.Body>
    </Card>
<br/>
<Card>
<Card.Header style={{ fontWeight: "bold" }}>Contato</Card.Header>
<Card.Body>
  <blockquote className="blockquote mb-0">

      

    <p className='titulos'>
      {' '}
      (22) 9-9984-2434{' '}
    </p>
    
  </blockquote>
</Card.Body>
</Card>
<br/>
<Card>
<Card.Header style={{ fontWeight: "bold" }}>Endereço</Card.Header>
<Card.Body>
  <blockquote className="blockquote mb-0">

      
    <p className='titulos'>
      {' '}
      Rua Professora Agricolina de Freitas, 23
Campos dos Goytacazes - RJ
Centro - 28013015{' '}
    </p>

  </blockquote>
</Card.Body>
</Card>

</div>

<div className='cards-info'>
    <text>
      Associado, é um prazer te ter conosco. Lembre-se dos benefícios de ser um cooperado.
    </text>
</div>

<div className='cards-info'>

</div>


</Row>
<Button variant="primary">Reeditar</Button>
</Container>


</div>
  );
}

export default Cards;