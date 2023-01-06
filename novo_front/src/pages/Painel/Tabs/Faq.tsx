import { Accordion, Container } from "react-bootstrap"

const Faq = () => {
    return (
        <Container style={{ paddingTop: "15px"}}>
            <h1>FAQ - Perguntas Frequentes</h1>
            <hr/>
            <h3>Informações de Preenchimento</h3>
            <br/>
        <Accordion defaultActiveKey="0">
      <Accordion.Item eventKey="0">
        <Accordion.Header>Quando utilizar a função enviar?</Accordion.Header>
        <Accordion.Body>
        A função "Enviar" deverá ser utilizada somente quando todo formulário estiver preenchido e ao menos uma mensalidade for paga clicando no último item da barra de opções. Havendo necessidade de mudança nos dados enviados, clique na função "Reeditar" e todas as lacunas de preenchimento estarão aptas a serem modificadas. Um link será enviado para o e-mail ou um código para o celular. Siga as instruções.
        </Accordion.Body>
      </Accordion.Item>
      <Accordion.Item eventKey="1">
        <Accordion.Header>Quando utilizar a versão salvar?</Accordion.Header>
        <Accordion.Body>
        A função "Salvar" poderá ser utilizada a qualquer momento durante o preenchimento e assim garantir o que já foi preenchido não será perdido. Usando esta função, você poderá concluir o preenchimento novamente quando desejar.
        </Accordion.Body>
      </Accordion.Item>
      <Accordion.Item eventKey="2">
        <Accordion.Header>Quando utilizar a versão Visualizar/Imprimir?</Accordion.Header>
        <Accordion.Body>
        A função "Visualizar/Imprimir" encontrará o Formulário PRODIST padrão ANEEL pag. 73. Será neste formulário que enviaremos seus dados a Distribuidora de Energia responsável pelo seu município.
        </Accordion.Body>
      </Accordion.Item>
      <Accordion.Item eventKey="3">
        <Accordion.Header>Quando utilizar a versão reeditar?</Accordion.Header>
        <Accordion.Body>
        A função "Reeditar" Clique em reeditar quando for fazer alterações nos dados já enviados a cooperativa. Será enviado um link para o e-mail usado no ato do cadastro. No caso de mudança de celular, será necessário o envio de link para o mesmo e-mail usado no cadastro. Mudança de e-mail enviaremos código via SMS para o celular usado no ato do cadastro.
        </Accordion.Body>
      </Accordion.Item>
      <Accordion.Item eventKey="4">
        <Accordion.Header>Quando utilizar a versão Deletar?</Accordion.Header>
        <Accordion.Body>
        A função "Deletar conta". Clique em deletar conta para remover todos seus dados e sair da cooperativa. Agradecemos se deixar um feedback sobre as razões de sua saída.
        </Accordion.Body>
      </Accordion.Item>
      
    </Accordion>
    </Container>
    )
}

export default Faq