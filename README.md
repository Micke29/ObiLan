# ObiLan

## INSTALLATION DU SITE

1. Adapter */config/config.requeteSQL.php ligne 10* avec votre configuration
2. Créer de la base avec */SQL/creation\_bdd\_obilan.sql*

## GESTION DES ERREURS A L'INSCRIPTION

1. Renvoi sur la page d'inscription avec un pop-up expliquant l'erreur
2. Si erreur d'écriture dans la base, renvoi l'erreur exacte en console

## ENVOI DE MAIL

**/!\ NE PAS CHANGER L'ORDRE DES DÉCLARATIONS /!\\** 

## PLUG-IN FB

/!\ Si protection contre le pistage activé sur le navigateur client, blocage du plug-in

## SUPPRESSION JOUEUR SANS EQUIPE

*Via l'interface admin*

Ligne en rouge dans le tableau "joueur", cliquer sur l'icone au bout de la ligne

*Via la bdd*

    SET FOREIGN_KEY_CHECK = 0;
    DELETE FROM `t_compte_cpt`
    NATURAL JOIN `t_joueur_jou` NATURAL JOIN `t_joint_piz_jou` 
    WHERE `equ_id` = "0";
    SET FOREIGN_KEY_CHECK = 1;