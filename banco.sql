create database formas;
use formas;
create table quadrado (
    id int primary key auto_increment,
    lado varchar(250),
    opt tinyint(1),
    cor varchar(250),
    id_un int,
    foreing key (id_un) references unidademedida (id)
);
create table unidademedida(
    id int primary key auto_increment,
    un varchar(3)
);

insert into unidademedida values(null,'px');
insert into unidademedida values(null,'cm');
insert into unidademedida values(null,'mm');
insert into unidademedida values(null,'in');

commit;