/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  19/04/2018 14:47:58                      */
/*==============================================================*/


drop table if exists MESSAGES;

drop table if exists UTILISATEURS;

/*==============================================================*/
/* Table : MESSAGES                                             */
/*==============================================================*/
create table MESSAGES
(
   MESSAGE_ID           int not null auto_increment,
   UTILISATEUR_ID       int not null,
   TITRE                varchar(80),
   TEXTE                text not null,
   primary key (MESSAGE_ID)
);

/*==============================================================*/
/* Table : UTILISATEURS                                         */
/*==============================================================*/
create table UTILISATEURS
(
   UTILISATEUR_ID       int not null auto_increment,
   SURNOM               char(40) not null,
   MAIL                 varchar(255) not null,
   MDP                  varchar(255) not null,
   primary key (UTILISATEUR_ID)
);

alter table MESSAGES add constraint FK_ENVOYER foreign key (UTILISATEUR_ID)
      references UTILISATEURS (UTILISATEUR_ID) on delete restrict on update restrict;

