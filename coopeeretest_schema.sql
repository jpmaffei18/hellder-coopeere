create table tabusuario (id integer not null auto_increment primary key,
email varchar(100), nivel varchar(50), senha varchar(50), token_email varchar(20), token_telefone varchar(20), token_change_psw varchar(20), token_reedit_prodist varchar(20),
cpf_cnpj varchar(25) not null unique, telefone varchar(25), email_verificado_em datetime, telefone_verificado_em datetime, updated_at datetime, created_at datetime);

create table taboperadora (id integer not null auto_increment primary key,
nome varchar(255),updated_at datetime, created_at datetime);

create table tabcooperado (id integer not null auto_increment primary key,
tipo varchar(100), nome varchar(255), cep varchar(9),
endereco varchar(255), numero varchar(10), bairro varchar(255), cidade varchar(255),
estado varchar(2), cpf_cnpj varchar(25) not null unique, inscricao_estadual varchar(20), inscricao_municipal varchar(20), idoperadora integer,
tipo_conta varchar(255), sorteio integer, status varchar(50), grupo_conta integer, token_convite varchar(20), token_convidado varchar(20), meio_pagamento varchar(30), periodicidade varchar(20), dia_vencimento integer,
updated_at datetime, created_at datetime,
CONSTRAINT fk_id FOREIGN KEY (idoperadora) REFERENCES taboperadora (id));

create table tabarquivo (id integer not null auto_increment primary key,
doc_conta varchar(255),cpf_cnpj varchar(25), doc_comprovante varchar(255),updated_at datetime, created_at datetime); 

create table tabcobranca (id integer not null auto_increment primary key,
cod_parcela varchar(35), parcela varchar(6), dt_processamento date, dt_vencimento date, valor_a_pagar decimal (10,2), dt_pagamento date, valor_pago decimal(10,2), num_documento varchar(25), idarquivo integer, status varchar(20), cpf_cnpj varchar(25),updated_at datetime, created_at datetime);

create table tabprodist (id integer not null auto_increment primary key,
idoperadoraprodist integer, idcooperadoprodist integer, codigo_uc integer, classe_uc varchar(45), 
numero_do_cliente varchar(25),menor_consumo decimal (10,2), maior_consumo decimal (10,2), cota_comprada decimal (10,2),
saldo_cota decimal (10,2),potencia_inst_uc decimal (10,2), potencia_inst_gerada decimal (10,2), tensao_atendimento integer,
tipo_conexao varchar(25), tipo_ramal varchar(25),tipo_fonte_geracao varchar(25), consumo_kwh_lista varchar(25), 
lista_atual integer, statusreg char(1), form_tab integer);

#ALTER TABLE tabcooperado
#ADD CONSTRAINT fk_cpfcnpjtabcooperado FOREIGN KEY (cpf_cnpj) REFERENCES tabusuario (cpf_cnpj);

ALTER TABLE tabprodist
ADD CONSTRAINT fk_idoperadoraprodist FOREIGN KEY (idoperadoraprodist) REFERENCES taboperadora (id);

ALTER TABLE tabprodist
ADD CONSTRAINT fk_idcooperadoprodist FOREIGN KEY (idcooperadoprodist) REFERENCES tabcooperado (id);

create table tabemailconfig(id integer not null auto_increment primary key, email_remetente varchar(255), servidor varchar(255), porta integer, usuario varchar(255), senha varchar(255), tls boolean );
create table tabsmsgatewayconfig(id integer not null auto_increment primary key, nome_servico varchar(255), base_url varchar(255), hash_integracao varchar(255));
create table tabfinanceiroconfig(id integer not null auto_increment primary key, nome_servico varchar(255), base_url varchar(255), api_key varchar(255), dia_vencimento integer);
create table tabpixconfig(id integer not null auto_increment primary key, nome_banco varchar(255), base_url varchar(255), api_key varchar(255), recebedor_pix varchar(255));
create table tabtensaoatendimento(id integer not null auto_increment primary key, tensao_atendimento integer );
create table tabtipoconexao(id integer not null auto_increment primary key, tipo varchar(100));
create table tabtiporamal(id integer not null auto_increment primary key, tipo varchar(100));
create table tabtipofontegeracao(id integer not null auto_increment primary key, tipo varchar(100));
create table tabperiodicidade(id integer not null auto_increment primary key, periodicidade varchar(20), num_parcelas integer, valor decimal (10,2));
create table tabmeiopagamento(id integer not null auto_increment primary key, meio_pagamento varchar(30));
create table tabperiodicidademeiodepagamento(id integer not null auto_increment primary key, periodicidade varchar(20), meio_pagamento varchar(30), valor decimal (10,2));
create table tabdiadevencimento(id integer not null auto_increment primary key, dia_vencimento integer);
