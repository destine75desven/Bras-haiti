<?php
header('Content-type: text/html; charset=UTF-8');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Save data into a file
    $file = fopen("users.txt", "a"); // a = ajoute nan fichye a
    if ($file) {
        fwrite($file, "$nom|$email|$password\n");
        fclose($file);

        echo "Compte créé avec succès! <a href='bras Haiti.html'>Retour à la connexion</a>";
    } else {
        echo "Erreur lors de la création du compte. Réessayez plus tard.";
    }
}
?>
