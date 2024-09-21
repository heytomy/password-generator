document.addEventListener("DOMContentLoaded", function () {
    const lengthSlider = document.getElementById("length");
    const lengthValue = document.getElementById("lengthValue");
    const copyButton = document.getElementById("copyButton");
    const passwordForm = document.getElementById("passwordForm");
    const passwordTextarea = document.getElementById("password");

    lengthSlider.addEventListener("input", () => {
        lengthValue.textContent = lengthSlider.value;
    });

    passwordForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission
        const formData = new FormData(passwordForm);

        // Extract selected options from formData
        const length = formData.get("length");
        const specialChars = formData.get("special_chars") === "on";
        const letters = formData.get("letters") === "on";
        const numbers = formData.get("numbers") === "on";
        const symbols = formData.get("symbols") === "on";

        // Define character sets based on selected options
        let charset = "";
        if (specialChars) {
            charset += "!@#$%^&*()";
        }
        if (letters) {
            charset += "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        }
        if (numbers) {
            charset += "0123456789";
        }
        if (symbols) {
            charset += "!@#$%^&*()";
        }

        if (charset === "") {
            alert("Veuillez sélectionner au moins un type de caractères.");
            return;
        }

        // Implement your password generation logic here
        // For this example, we'll generate a random password using the selected character set
        let password = "";

        while (password.length < length) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset.charAt(randomIndex);
        }

        passwordTextarea.value = password; // Display the generated password

        // Scroll to the password output
        passwordTextarea.scrollIntoView({ behavior: "smooth" });
    });

    copyButton.addEventListener("click", function () {
        passwordTextarea.select();
        document.execCommand("copy");
        alert("Mot de passe copié dans le presse-papiers !");
    });
});
