create database if not exists phpcrud;
use phpcrud;

alter database phpcrud character set utf8 collate utf8_general_ci;

create table if not exists pessoas (
    id int not null auto_increment primary key,
    nome varchar(50), 
    email varchar(100), 
    cpf varchar(14));