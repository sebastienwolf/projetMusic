<?php
session_start();
if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    // connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=test', 'sebastien', 'sebastien')
        or die('could not connect to database');


    // prépare nos variable d'entré
    // $userNom = $_POST['nom'];
    // $userPrenom = $_POST['prenom'];
    // $userAge = $_POST['age'];
    $userPseudo = $_POST['pseudo'];
    // $userMail = $_POST['mail'];
    $userPassword = $_POST['password'];

    $option = ['cost' => 12,];
    $hash = password_hash($userPassword, PASSWORD_BCRYPT, $option);

    //    if ($userNom !== "" && $userPrenom !== "" && $userAge !== "" && $userPseudo !== "" && $userMail !== "" && $userPassword !== "") {
    if (isset($userPseudo) && isset($userPassword)) {

        // prepare la requete
        $requete = $db->prepare("SELECT login FROM pseudo where login = :userPseu");
        // execution de la requete  
        $requete->execute(["userPseu" => $userPseudo]);
        /// transformer le retour en tableau 
        $reponse = $requete->fetchAll();
        // vérification du mot de passe en variable 
        $verifPseudo = count($reponse);


        if ($verifPseudo == 0) {
            // vérification si l'utilisateur existe
            // $requeteInscription = "INSERT INTO user (idUser, nom, prenom, age, pseudo, mail, mdp) VALUES
            // (DEFAULT, '$userNom', '$userPrenom', '$userAge', '$userPseudo', '$userMail','$hash')";
            $requeteInscription = "INSERT INTO pseudo (idPseudo, login, mdp) VALUES
            (DEFAULT, '$userPseudo', '$hash')";
            $db->query($requeteInscription);
            $_SESSION['login'] = $userPseudo;
            header('Location: ../principal/principale.php');
        } else {
            header('Location: ../index.php?erreur=5');
        }
    } else {
        header('Location: ../index.php?erreur=3');
    }
} else {
    header('Location: ../index.php');
}
