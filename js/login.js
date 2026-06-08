$(document).ready(function(){
    $("#loginBtn").click(function(e){
        e.preventDefault();

        let email = $("#email").val().trim();
        let password = $("#password").val().trim();

        if (email === '' || password === '') {
            alert("Please enter both email and password.");
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        $.ajax({
            url: "php/login.php",
            type: "POST",
            dataType: "json",
            data: {
                email: email,
                password: password
            },
            success: function(data){
                if (data.status === "success") {
                    // Store authentication state in localStorage
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('userEmail', data.email);
                    localStorage.setItem('userName', data.name);
                    if (data.userId) {
                        localStorage.setItem('userId', data.userId);
                    }
                    window.location.href = "profile.html";
                } else {
                    alert(data.message || "Invalid credentials");
                }
            },
            error: function(xhr, status, error){
                console.log("AJAX ERROR", xhr.responseText || error);
                alert("Unable to complete login request. Please try again.");
            }
        });
    });
});