document.addEventListener("DOMContentLoaded", function() {
    const popup = document.getElementById("tweetPopup");
    const btnTweet = document.querySelector(".btn-tweet");
    const closeBtn = document.querySelector(".close");

    btnTweet.addEventListener("click", function(event) {
        event.preventDefault();
        popup.style.display = "flex";
    });

    
    closeBtn.addEventListener("click", function() {
        popup.style.display = "none";
    });

    
    window.addEventListener("click", function(event) {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });
});