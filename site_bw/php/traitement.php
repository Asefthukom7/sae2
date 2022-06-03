<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bubblewavessql', 'root', '');

if(isset($_POST['forminscription']))
{
    if(!empty($_POST['mail']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['portable']))
    {
        $mail = htmlspecialchars($_POST['mail']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $motdepasse = sha1($_POST['mdp']);
        $telephone = number_format($_POST['telephone']);

        $pseudolength = strlen ($pseudo);
        if($pseudolength <= 255)
        {
            $insertmbr = $bdd->prepare("INSERT INTO utilisateur(pseudo, mail, telephone, motdepasse) VALUES(?, ?, ?, ?)");
            $insertmbr->execute(array($pseudo, $mail, $telephone, $motdepasse));
            $erreur  = "Votre compte à bien été crée";
        }  
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères.";
        }
        

    }
    else
    {
        $erreur = "Rempli tous les champs là !!!!";
    }

}



if(isset($erreur))
{
    echo $erreur;
}

?>