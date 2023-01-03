<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de mot de passe</title>
</head>

<body>
    <h1>Générateur de mots de passe</h1>
    <!-- Formulaire permettant à l'utilisateur de choisir les paramètres du mot de passe -->
    <form action="" method="post">
        <label for="length">Longueur du mot de passe :</label>
        <!-- Slider permettant de choisir la longueur du mot de passe (de 8 à 32 caractères) -->
        <input type="range" name="length" id="length" min="12" max="32" value="12">
        <br>
        <label for="special_chars">Inclure des caractères spéciaux :</label>
        <!-- Checkbox permettant de choisir si le mot de passe doit inclure des caractères spéciaux -->
        <input type="checkbox" name="special_chars" id="special_chars" value="1">
        <br>
        <label for="letters">Inclure des lettres :</label>
        <!-- Checkbox permettant de choisir si le mot de passe doit inclure des lettres -->
        <input type="checkbox" name="letters" id="letters" value="1">
        <br>
        <label for="numbers">Inclure des chiffres :</label>
        <!-- Checkbox permettant de choisir si le mot de passe doit inclure des chiffres -->
        <input type="checkbox" name="numbers" id="numbers" value="1">
        <br>
        <label for="symbols">Inclure des symboles :</label>
        <!-- Checkbox permettant de choisir si le mot de passe doit inclure des symboles -->
        <input type="checkbox" name="symbols" id="symbols" value="1">
        <br>
        <!-- Bouton de soumission du formulaire -->
        <input type="submit" value="Générer le mot de passe">
    </form>

    <?php
    // Fonction pour générer un mot de passe sécurisé
    function generatePassword($length, $special_chars, $letters, $numbers, $symbols)
    {
        $chars = '';

        // Si l'utilisateur veut des caractères spéciaux, on ajoute ces caractères à la liste de caractères possibles
        if ($special_chars) {
            $chars .= '!@#$%^&*';
        }

        // Si l'utilisateur veut des lettres, on ajoute les lettres minuscules et majuscules à la liste de caractères possibles
        if ($letters) {
            $chars .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        // Si l'utilisateur veut des chiffres, on ajoute les chiffres à la liste de caractères possibles
        if ($numbers) {
            $chars .= '0123456789';
        }

        // Si l'utilisateur veut des symboles, on ajoute ces symboles à la liste de caractères possibles
        if ($symbols) {
            $chars .= '!@#$%^&*()';
        }

        // On initialise le mot de passe à vide
        $password = '';

        // On génère aléatoirement un caractère à chaque itération de la boucle
        for ($i = 0; $i < $length; $i++) {
            // On choisit aléatoirement un caractère dans la liste de caractères possibles
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        // On retourne le mot de passe généré
        return $password;
    }

    // Si le formulaire a été soumis
    if (isset($_POST['length'])) {
        // On récupère les valeurs des paramètres choisis par l'utilisateur
        $length = (int)$_POST['length'];
        $special_chars = (bool)$_POST['special_chars'];
        $letters = (bool)$_POST['letters'];
        $numbers = (bool)$_POST['numbers'];
        $symbols = (bool)$_POST['symbols'];

        // On génère le mot de passe en utilisant la fonction PHP generatePassword
        $password = generatePassword($length, $special_chars, $letters, $numbers, $symbols);
    }
        // On affiche le mot de passe généré à l'utilisateur
        echo "<p>Mot de passe généré : $password</p>";

    ?>

</body>
</html>