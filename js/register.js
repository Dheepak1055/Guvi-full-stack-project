$(document).ready(function () {
    $("#registerBtn").click(function () {
        let name = $("#name").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();

        if (name === "" || email === "" || password === "") {
            alert("Name, email, and password are required.");
            return;
        }

        if (name.length < 3 || name.length > 50) {
            alert("Name must be between 3 and 50 characters.");
            return;
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Enter a valid email address.");
            return;
        }

        if (password.length < 8) {
            alert("Password must contain at least 8 characters.");
            return;
        }

        if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password)) {
            alert("Password must include uppercase, lowercase, and number.");
            return;
        }

        $.ajax({
            url: "php/register.php",
            type: "POST",
            dataType: "json",
            data: {
                name: name,
                email: email,
                password: password
            },
            success: function (data) {
                if (data.status === "success") {
                    alert(data.message);
                    window.location.href = "login.html";
                } else {
                    alert(data.message || "Registration failed.");
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX ERROR", xhr.responseText || error);
                alert("Unable to complete registration request.");
            }
        });
    });
});