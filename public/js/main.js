document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.getElementById("username");
    const statusParagraph = document.getElementById("username-status");
    let timeout;

    usernameInput.addEventListener("input", function() {
        clearTimeout(timeout);

        timeout = setTimeout(function() {
            const username = usernameInput.value;

            if (username !== "") {
                fetch("utils/register_validation.php", {
                    method: "POST",
                    body: JSON.stringify({ username: username }),
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                    .then(response => response.json())
                    .then(data => {

                        if (data === true) {
                            statusParagraph.classList.remove("valid");
                            statusParagraph.classList.remove("d-none");
                            statusParagraph.classList.add("taken");
                            statusParagraph.textContent = "Username je zauzet.";

                        } else if (data === false) {
                            statusParagraph.classList.remove("taken");
                            statusParagraph.classList.remove("d-none");
                            statusParagraph.classList.add("valid");
                            statusParagraph.textContent = "Username je slobodan.";
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            } else {
                statusParagraph.textContent = "";
                statusParagraph.classList.add("d-none");
            }
        }, 2000); // Ovo je 2 sekunde, prilagodite ako želite drugačije trajanje
    });
});


