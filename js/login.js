$("#loginBtn").click(function () {

    let email = $("#email").val().trim();

    let password = $("#password").val().trim();


    if (email == "" || password == "") {

        $("#message").html(
            '<div class="alert alert-danger">All Fields Required</div>'
        );

        return;

    }


    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    if (!emailPattern.test(email)) {

        $("#message").html(
            '<div class="alert alert-danger">Enter Valid Email</div>'
        );

        return;

    }


    if (password.length < 6) {

        $("#message").html(
            '<div class="alert alert-danger">Password must contain minimum 6 characters</div>'
        );

        return;

    }


    $.ajax({

        url: "php/login.php",

        type: "POST",

        data: {
            email: email,
            password: password
        },

        success: function (response) {

            console.log(response);


            if (response=="Login Successful") {

                localStorage.setItem("user", email);

                    window.location.href = "profile.html";

            }

            else {

                $("#message").html(
                    '<div class="alert alert-danger">Invalid Credentials</div>'
                );

            }

        }

    });

});