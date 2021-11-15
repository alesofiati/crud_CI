create database crud;

create table pessoas(
	idPessoa int primary key auto_increment,
	nome varchar(255) not null,
	email varchar(100) unique not null
);
