document.addEventListener("DOMContentLoaded", function() {
    const countryLookupButton = document.getElementById("countrylook");
    const cityLookupButton = document.getElementById("citylook");

    countryLookupButton.addEventListener("click", function() {
        const countryInput = document.getElementById("country").value.trim();

        if (countryInput.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "world.php?country=" + encodeURIComponent(countryInput), true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const resultContainer = document.getElementById("result");
                    resultContainer.innerHTML = xhr.responseText;
                } else {
                    console.error("Request failed with status: " + xhr.status);
                }
            };

            xhr.send();
        } else {
            alert("Please enter a country name to search.");
        }
    });

    cityLookupButton.addEventListener("click", function() {
        const countryInput = document.getElementById("country").value.trim();

        if (countryInput.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "world.php?cities=true&country=" + encodeURIComponent(countryInput), true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const resultContainer = document.getElementById("result");
                    resultContainer.innerHTML = xhr.responseText;
                } else {
                    console.error("Request failed with status: " + xhr.status);
                }
            };

            xhr.send();
        } else {
            alert("Please enter a country name to search.");
        }
    });
});
