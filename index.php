<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Générateur de mot de passe</title>
</head>

<body>
    <h1>Générateur de mots de passe</h1>
    <!-- Form allowing the user to choose password parameters -->
    <form action="" method="post">
        <label for="length">Longueur du mot de passe :</label>
        <input type="range" name="length" id="length" min="8" max="32" value="12">
        <span id="lengthValue">12</span> caractères
        <br>
        <label for="special_chars">Inclure des caractères spéciaux :</label>
        <input type="checkbox" name="special_chars" id="special_chars" value="1" checked>
        <br>
        <label for="letters">Inclure des lettres :</label>
        <input type="checkbox" name="letters" id="letters" value="1" checked>
        <br>
        <label for="numbers">Inclure des chiffres :</label>
        <input type="checkbox" name="numbers" id="numbers" value="1" checked>
        <br>
        <label for="symbols">Inclure des symboles :</label>
        <input type="checkbox" name="symbols" id="symbols" value="1" checked>
        <br>
        <input type="submit" value="Générer le mot de passe">
    </form>

    <?php
// Function to generate a secure password
function generatePassword($length, $special_chars, $letters, $numbers, $symbols)
{
    // Check if at least one character set is selected
    if (!$special_chars && !$letters && !$numbers && !$symbols) {
        return "Veuillez sélectionner au moins un jeu de caractères.";
    }

    // Define character sets
    $charset = '';
    if ($special_chars) {
        $charset .= '!@#$%^&*';
    }
    if ($letters) {
        $charset .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    if ($numbers) {
        $charset .= '0123456789';
    }
    if ($symbols) {
        $charset .= '!@#$%^&*()';
    }

    // Generate the password securely
    $password = '';
    $charset_length = strlen($charset);
    for ($i = 0; $i < $length; $i++) {
        $random_index = random_int(0, $charset_length - 1);
        $password .= $charset[$random_index];
    }

    return $password;
}

// If the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $length = isset($_POST['length']) ? max(8, min(32, (int)$_POST['length'])) : 12;
    $special_chars = isset($_POST['special_chars']) ? true : false;
    $letters = isset($_POST['letters']) ? true : false;
    $numbers = isset($_POST['numbers']) ? true : false;
    $symbols = isset($_POST['symbols']) ? true : false;

    // Generate the password using the PHP generatePassword function
    $password = generatePassword($length, $special_chars, $letters, $numbers, $symbols);

    // Display the generated password to the user
    echo "<p>Mot de passe généré : $password</p>";
}
?>


    <script>
        // Display the current value of the length slider
        const lengthSlider = document.getElementById("length");
        const lengthValue = document.getElementById("lengthValue");
        lengthSlider.addEventListener("input", () => {
            lengthValue.textContent = lengthSlider.value;
        });
    </script>
</body>
</html>
