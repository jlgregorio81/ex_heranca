create sequence seq_pessoa;

create table pessoa(
   id integer not null default nextval('seq_pessoa'),
   nome varchar(50),
   constraint pk_pessoa primary key (id)
);

create table pessoa_fisica(
   id integer not null,
   sexo char(1) not null,
   rg varchar(30) not null,
   cpf char(11) not null,
   constraint pk_pessoa_fisica primary key (id)
);