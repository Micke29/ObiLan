DROP TABLE IF EXISTS `t_compte_cpt`;
CREATE TABLE t_compte_cpt
  (
    cpt_id     INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cpt_pseudo VARCHAR (32) NOT NULL,
    cpt_mdp    VARCHAR (64) NOT NULL,
    cpt_mail   VARCHAR (64) NOT NULL,
    cpt_date   DATE NOT NULL
  ) ;


DROP TABLE IF EXISTS `t_equipe_equ`;
CREATE TABLE t_equipe_equ
  (
    equ_id       INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    equ_nom      VARCHAR (32) NOT NULL,
    equ_acronyme VARCHAR (6) NOT NULL
  ) ;

DROP TABLE IF EXISTS `t_jeu_jeu`;
CREATE TABLE t_jeu_jeu
  (
    jeu_id  INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jeu_nom VARCHAR (32) NOT NULL
  ) ;

DROP TABLE IF EXISTS `t_joint_equ_jeu`;
CREATE TABLE t_joint_equ_jeu
  (
    jeu_id INTEGER NOT NULL,
    equ_id INTEGER NOT NULL
  ) ;
ALTER TABLE t_joint_equ_jeu ADD CONSTRAINT Relation_4_PK PRIMARY KEY ( jeu_id, equ_id );

DROP TABLE IF EXISTS `t_joint_piz_jou`;
CREATE TABLE t_joint_piz_jou
  (
    piz_id     INTEGER NOT NULL,
    jou_id     INTEGER NOT NULL,
    piz_date   VARCHAR (32) NOT NULL
  ) ;
ALTER TABLE t_joint_piz_jou ADD CONSTRAINT t_joint_piz_jou_PK PRIMARY KEY ( piz_id, jou_id );

DROP TABLE IF EXISTS `t_joueur_jou`;
CREATE TABLE t_joueur_jou
  (
    jou_id        INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jou_nom       VARCHAR (32) NOT NULL,
    jou_prenom    VARCHAR (32) NOT NULL,
    jou_telephone VARCHAR (32),
    jou_capitaine INTEGER NOT NULL,
    equ_id        INTEGER NOT NULL,
    cpt_id        INTEGER NOT NULL
  ) ;


DROP TABLE IF EXISTS `t_pizza_piz`;
CREATE TABLE t_pizza_piz
  (
    piz_id  INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    piz_nom VARCHAR (32) NOT NULL,
    piz_prix  DECIMAL (3,2) NOT NULL
  ) ;

DROP TABLE IF EXISTE `t_admin_adm`;
CREATE TABLE t_admin_adm
  (
    adm_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    adm_pseudo VARCHAR (32) NOT NULL,
    adm_mdp VARCHAR (64) NOT NULL
  );

ALTER TABLE t_joint_equ_jeu ADD CONSTRAINT FK_ASS_2 FOREIGN KEY ( jeu_id ) REFERENCES t_jeu_jeu ( jeu_id );

ALTER TABLE t_joint_equ_jeu ADD CONSTRAINT FK_ASS_3 FOREIGN KEY ( equ_id ) REFERENCES t_equipe_equ ( equ_id );

ALTER TABLE t_joint_piz_jou ADD CONSTRAINT FK_ASS_5 FOREIGN KEY ( piz_id ) REFERENCES t_pizza_piz ( piz_id );

ALTER TABLE t_joint_piz_jou ADD CONSTRAINT FK_ASS_6 FOREIGN KEY ( jou_id ) REFERENCES t_joueur_jou ( jou_id );

ALTER TABLE t_joueur_jou ADD CONSTRAINT t_compte_cpt_FK FOREIGN KEY ( cpt_id ) REFERENCES t_compte_cpt ( cpt_id );

ALTER TABLE t_joueur_jou ADD CONSTRAINT t_equipe_equ_FK FOREIGN KEY ( equ_id ) REFERENCES t_equipe_equ ( equ_id );

insert into t_jeu_jeu (jeu_nom)
  values ('');

insert into t_pizza_piz (piz_nom,piz_prix)
  values ('','');

insert into t_admin_adm (adm_id,adm_pseudo,adm_mdp)
  values ('1','admin',sha1('gEstionnaire_OBI1'));