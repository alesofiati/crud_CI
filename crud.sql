create database crud;

create table pessoa(
	idPessoa int primary key auto_increment,
	nome varchar(255),
	email varchar(100)
);

create table endereco(
    id int primary key auto_increment,
    pessoa_id int,
    rua varchar(50),
    constraint foreign key (pessoa_id) references pessoa (idPessoa)
);
