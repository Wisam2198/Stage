document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        let fields = document.querySelectorAll("input, textarea");
        let isAnyFieldEmpty = false;

        fields.forEach(function(field) {
            if (field.value.trim() === "") {
                isAnyFieldEmpty = true;
                field.classList.add("error");
            } else {
                field.classList.remove("error");
            }
        });

        if (isAnyFieldEmpty) {
            event.preventDefault(); // Empêche l'envoi du formulaire si des champs sont vides
            alert("Veuillez remplir tous les champs !");
        }
    });
});