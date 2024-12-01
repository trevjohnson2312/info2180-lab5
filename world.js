document.addEventListener("DOMContentLoaded", function() {
    // Get the lookup button element
    const lookupButton = document.getElementById("lookup");

    // Event listener for the "Lookup" button click
    lookupButton.addEventListener("click", function() {
        const countryInput = document.getElementById("country").value.trim();

        // Only proceed if there is a country entered
        if (countryInput.length > 0) {
            // Create an XMLHttpRequest object
            const xhr = new XMLHttpRequest();

            // Configure the GET request to the PHP file
            xhr.open("GET", "world.php?country=" + encodeURIComponent(countryInput), true);

            // Set up a function to handle the response
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Insert the response HTML into the result div
                    const resultContainer = document.getElementById("result");
                    resultContainer.innerHTML = xhr.responseText; // Inject table or error message
                } else {
                    console.error("Request failed with status: " + xhr.status);
                }
            };

            // Send the request
            xhr.send();
        } else {
            alert("Please enter a country name to search.");
        }
    });
});
