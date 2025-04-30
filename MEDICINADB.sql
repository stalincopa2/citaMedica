create database `medicina`;

use `medicina`;

/*TABLA: medempre 
En esta tabla se guardan los datos generales de la empresa, en este caso del centro medico*/
create table `medicina`.`medempre`(
empre_id_empre int not null,
empre_nom_empre varchar (100),
empre_ruc_empre varchar (100),
primary key (empre_id_empre) 
);

/*TABLA: medpacie
En esta tabla se guardan los datos generales del paciente*/

create table  `medicina`.`medpacie`(
pacie_id_pacie   int auto_increment not null,
pacie_nom_pacie  varchar (50) not null,
pacie_ape_pacie  varchar (50) not null,
pacie_ide_pacie  varchar(13) unique not null,
primary key(pacie_id_pacie)
);

/*TABLA: medespec
En esta tabla se guardan las especialidades*/
create table `medicina`.`medespec`(
espec_id_espec int not null,
espec_nom_espec varchar(100) not null,
espec_id_empre int not null,
primary key(espec_id_espec),
foreign key (espec_id_empre) references medempre(empre_id_empre) 
);

/*TABLA: medmedic
En esta tabla se guardan los datos generales del medico*/
create table `medicina`.`medmedic`(
medic_id_medic  int auto_increment  not null,
medic_ide_medic varchar (13) unique not null,
medic_nom_medic varchar (100) not null,
medic_ape_medic varchar (100) not null,
primary key (medic_id_medic) 
);



/*TABLA: medcita
en esta tabla se guardan las citas medicas*/

create table `medicina`.`medcita`(
cita_id_cita int auto_increment not null,
cita_det_cita text not null,
cita_fec_cita timestamp not null,
cita_id_pacie int not null,
cita_id_medic int not null,
cita_id_espec int not null, 
primary key (cita_id_cita ),
foreign key (cita_id_pacie)  references medpacie (pacie_id_pacie),
foreign key (cita_id_medic)  references medmedic (medic_id_medic),
foreign key (cita_id_espec)  references medespec (espec_id_espec)
);


insert into medempre values (1, 'CENTRO MEDICO TU BIENESTAR', '0601256233001');

insert into medespec values (1, 'MEDICINA GENERAL',1);
insert into medespec values (2, 'PEDIATRIA',1);
insert into medespec values (3, 'DERMATOLOGIA',1);


insert into medmedic (medic_ide_medic, medic_nom_medic, medic_ape_medic) values ('0602963233', 'ruth elizabeth', 'copa bastidas');










