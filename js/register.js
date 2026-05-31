$(document).ready(function () {
    $("#registerBtn").click(function () {
        let name = $("#name").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        if (name === "" || email === "" || password === "") {
            alert("All Fields Required");
            return;
        }
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Enter Valid Email");
            return;
        }
        if (password.length < 6) {
            alert("Password must contain minimum 6 characters");
            return;
        }
        $.ajax({
            url: "php/register.php",
            type: "POST",
            data: {
                name: name,
                email: email,
                password: password
            },
            success: function (response) {
                alert(response);
                if (response.includes("Success")) {
                    localStorage.setItem("name", name);
                    window.location.href = "login.html";
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX ERROR - Check Console");
            }
        });
    });

});