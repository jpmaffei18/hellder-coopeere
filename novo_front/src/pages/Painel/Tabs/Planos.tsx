import { Container } from 'react-bootstrap';
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';

const Planos = () => {
    return (
        <Container className='d-flex' style={{paddingTop: "15px", gap: "15px"}}>

        <Card style={{ width: '18rem' }}>
        <Card.Body>
          <Card.Title>Plano Mensal</Card.Title>
          <Card.Title style={{fontSize: "50px"}}>R$ 3.50</Card.Title>
          <Card.Text>
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </Card.Text>
          <Button variant="primary">Adquirir Agora</Button>
        </Card.Body>
      </Card>

      <Card style={{ width: '18rem' }}>
        <Card.Body>
          <Card.Title>Plano Bimestral</Card.Title>
          <Card.Title style={{fontSize: "50px"}}>R$ 7</Card.Title>
          <Card.Text>
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </Card.Text>
          <Button variant="primary">Adquirir Agora</Button>
        </Card.Body>
      </Card>

      <Card style={{ width: '18rem' }}>
        <Card.Body>
          <Card.Title>Plano Trimestral</Card.Title>
          <Card.Title style={{fontSize: "50px"}}>R$ 10</Card.Title>
          <Card.Text>
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </Card.Text>
          <Button variant="primary">Adquirir Agora</Button>
        </Card.Body>
      </Card>

      <Card style={{ width: '18rem' }}>
        <Card.Body>
          <Card.Title>Plano Semestral</Card.Title>
          <Card.Title style={{fontSize: "50px"}}>R$ 18</Card.Title>
          <Card.Text>
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </Card.Text>
          <Button variant="primary">Adquirir Agora</Button>
        </Card.Body>
      </Card>

      <Card style={{ width: '18rem' }}>
        <Card.Body>
          <Card.Title>Plano Anual</Card.Title>
          <Card.Title style={{fontSize: "50px"}}>R$ 32</Card.Title>
          <Card.Text>
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </Card.Text>
          <Button variant="primary">Adquirir Agora</Button>
        </Card.Body>
      </Card>

      </Container>
    )
}

export default Planos