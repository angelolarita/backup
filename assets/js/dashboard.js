function hideLoading() {
            setTimeout(() => {
                document.getElementById("loading").style.opacity = "0";
                setTimeout(() => {
                    document.getElementById("loading").style.display = "none";
                }, 500);
            }, 2000);
}
        

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var loadingScreen = document.getElementById("loading");
        if (loadingScreen) {
            loadingScreen.classList.add("hidden"); 
            setTimeout(function () {
                loadingScreen.style.display = "none"; 
            }, 1000); 
        }
    }, 3000);
});

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("menuToggle").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("show");
    });
});