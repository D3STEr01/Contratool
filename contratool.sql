create database contratool;
use contratool;



CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

create table tbl_corretores(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)default charset utf8;

create table tbl_imovelTipo(
   itp_id int primary key auto_increment not null,
   itp_tipo varchar(50) not null
)default charset utf8;


create table tbl_imovelFinalidade(
   ifn_id int primary key auto_increment not null,
   itp_finalidade varchar(50) not null
)default charset utf8;


create table tbl_imovelComplemento(
   cpm_id int primary key auto_increment not null,
   cpm_tipo varchar(50) not null
)default charset utf8;



create table tbl_clientes(
   cli_id int primary key auto_increment not null,
   cli_nome varchar(150) not null,
   cli_cpf varchar(11) not null,
   cli_email varchar(150) not null,
   cli_telefone varchar(13) not null,
   cli_endereco varchar(50) not null,
   crr_id int not null
)default charset utf8;

create table tbl_contratos(
   ctt_id int primary key auto_increment not null,
   ctt_contrato varchar(250) not null,
   cli_id int not null,
foreign key (cli_id) references tbl_clientes(cli_id)
)default charset utf8;


create table tbl_imotbl_imoveisveis(
   imv_id int primary key auto_increment not null,
    imv_uf varchar(2) not null,
    imv_cep varchar(8) not null,
    imv_cidade varchar(50) not null,
    imv_bairro varchar(50) not null,
    imv_endereco varchar(50) not null,
    imv_numero int not null,
    ccr_id int not null,
    ctt_id int not null,
    itp_id int not null,
    ifn_id int not null,
    cpm_id int not null,

    foreign key (ccr_id) references tbl_corretores(ccr_id),
    foreign key (ctt_id) references tbl_mudar(ctt_id),
    foreign key (itp_id) references tbl_imovelTipo(itp_id),
    foreign key (ifn_id) references tbl_imovelFinalidade(ifn_id),
    foreign key (cpm_id) references tbl_imovelComplemento(cpm_id)
) default charset utf8;

drop table users;
drop table tbl_corretores;
drop table clientes;
select * from tbl_corretores;
select * from tbl_clientes;



