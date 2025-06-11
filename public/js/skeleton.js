document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        document.querySelector(".skeleton-loader").style.display = "none"; // Cache le loader
        document.querySelector(".real-content").style.display = "block";  // Affiche le vrai contenu
    }, 2000); // Attendre 5 secondes
});