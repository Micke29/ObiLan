<?php
	session_start();

	include("./config.requeteSQL.php");

	affichageErreur();

	if(isset($_SESSION['mail_contact']))
	{
		if($_POST['email'] && $_POST['sujet'] && $_POST['message'])
		{
			unset($_SESSION['mail_contact']);

			$mail = "association.obi1@gmail.com"; // Déclaration de l'adresse de destination.
			$message_txt = htmlspecialchars(addslashes($_POST['message'])); // Déclaration du message au format texte
		}
		else
		{
			$_SESSION['formulaire']=1;
			header("Location: ../contact.php");
			exit;
		}


		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		 
		$sujet = '['.htmlspecialchars(addslashes($_POST['jeu'])).']'.htmlspecialchars(addslashes($_POST['sujet'])); // Définition du sujet.

		//=====Création du header de l'e-mail.
		$header = "From: \"Serveur\"<tmp.smtp.nas@gmail.com>\n";
		$header.= "Reply-to: ".htmlspecialchars($_POST['email']."\n");	//répondre à l'adresse fourni lors de l'envoi
		$header.= "MIME-Version: 1.0";
		$header.= "Content-Type: multipart/alternative;\n boundary=\"$boundary\"\n";
		//==========
	 

		//=====Création du message.
		$message = "\n--".$boundary."\n";
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n";
		$message.= "Content-Transfer-Encoding: 8bit\n";
		$message.= "\n".$message_txt."\n";
		//==========
		$message.= "\n--".$boundary."--\n";
		//==========
		 

		//=====Envoi de l'e-mail.
		if(mail($mail,$sujet,$message,$header))
		{
			$_SESSION['envoi']=0;
			header("Location: ../contact.php");
			exit();
		}
		else
		{
			$_SESSION['envoi']=1;
			header("Location: ../contact.php");
			exit();
		}

		//==========
	}
	elseif(isset($_SESSION['mail_inscription']))
	{
		$email = $mail; // Déclaration de l'adresse de destination.
		$message_txt = "Votre inscription à l'Obilan est confirmé.\nBonne lan à vous.\n\nCeci est un mail automatique, toute réponse à cette adresse ne sera pas traitée.\n"; // Déclaration du message au format texte


		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		 
		$sujet = "Inscription Obilan"; // Définition du sujet.

		//=====Création du header de l'e-mail.
		$header = "From: \"Serveur\"<tmp.smtp.nas@gmail.com>\n";
		$header.= "MIME-Version: 1.0";
		$header.= "Content-Type: multipart/alternative;\n boundary=\"$boundary\"\n";
		//==========
	 

		//=====Création du message.
		$message = "\n--".$boundary."\n";
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n";
		$message.= "Content-Transfer-Encoding: 8bit\n";
		$message.= "\n".$message_txt."\n";
		//==========
		$message.= "\n--".$boundary."--\n";
		//==========
		 

		//=====Envoi de l'e-mail.
		mail($email,$sujet,$message,$header);
		//==========
	}
	else header("Location: ./");	
?>