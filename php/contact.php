<?php 
    // Code de première isntance avec initialisation des données
    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false; // initialisation de la variable de succès d'envoi du formulaire à faux = on affiche pas le message de succès à l'utlisateur
    $emailTo = 'wirth.romain@gmail.com';

    // Code de la deuxième instance
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = verifyInput($_POST['firstname']);
        $name = verifyInput($_POST['name']);
        $email = verifyInput($_POST['email']);
        $phone = verifyInput($_POST['phone']);
        $message = verifyInput($_POST['message']);
        $isSuccess = true; // une fois le formulaire 'posté' par l'utilisateur, la variable devient vraie = on affiche le message de succès à l'utilisateur
        $emailText = ""; // variable est une string vide

        if(empty($firstname)) { // si la case prénom est vide
            $firstnameError = "Merci de m'indiquer ton prénom"; // ce message s'affiche
            $isSuccess = false; // la variable isSuccess redevient false = pas d'affichage du message de validation
        } else { // si la case est remplie (else)
            $emailText .= "First Name: $firstname\n"; // on ajoute ces infos au message contenu dans l'email (variable emailText) avec la concaténation 
        }
        if (empty($name)) {
            $nameError = "Merci de m'indiquer ton nom";
            $isSuccess = false;
        } else {
            $emailText .= "Last Name: $name\n";
        }
        if(!isEmail($email)) {
            $emailError = "Merci d'indiquer une adresse email valide";
            $isSuccess = false;
        } else {
            $emailText .= "email : $email\n";
        }
        if(!isPhone($phone)) {
            $phoneError = "Merci d'indiquer un numéro de téléphone valide (chiffres et espaces uniquement)";
            $isSuccess = false;
        } else {
            $emailText .= "Telephone : $phone\n";
        }
        if(empty($message)) {
            $messageError = "Votre message est vide, merci de remplir ce champ";
            $isSuccess = false;
        } else {
            $emailText .= "Message: $message\n";
        }
        // ATTENTION : cette étape affiche une erreur en phase de développement (serveur fictif), ne fonctionnera qu'une fois en ligne
        // afin de tester : modifier le fichier texte PHP (php.ini) à la ligne sendmail_path et ajouter le chemin de xampp\mailtodisk\mailtodisk.exe
        if($isSuccess) { // une fois toutes les étapes de validation passées (isSuccess est 'true')
            $headers = "From: $firstname $name <$email>\r\nReply-to: $email";
            mail($emailTo, "Vous avez un nouveau message depuis votre site", $emailText, $headers);
            $firstname = $name = $email = $phone = $message = "";
        }
    }

    function isPhone($var) { // validation du téléphone avec la regEx
        return preg_match("/^[0-9 ]*$/", $var); // regEx chiffres de 0 à 9 et espaces acceptés
    }

    function isEmail($var) {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    // protection du formulaire : ajout de la fonction à chaque étape du formulaire
    function verifyInput($var) {
        $var = trim($var); // enlève tous les espaces
        $var = stripslashes($var); // enlève tous les '\'
        $var = htmlspecialchars($var); // permet de se protéger contre la faille XSS (injection de script dans le document par l'utilisateur)
        return $var;
    }
?>