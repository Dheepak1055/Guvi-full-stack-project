let email = "";
let name = "";

// Check localStorage for authentication
function checkAuthentication() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const userEmail = localStorage.getItem('userEmail');
    const userName = localStorage.getItem('userName');
    
    if (isLoggedIn !== 'true' || !userEmail || !userName) {
        // Not logged in, redirect to login page
        window.location.href = "login.html";
        return false;
    }
    
    email = userEmail;
    name = userName;
    return true;
}

$(document).ready(function(){
    // Define loadProfileData function first
    function loadProfileData() {
        $.ajax({
            url: "php/get_profile.php",
            type: "GET",
            dataType: "json",
            data: {
                email: email
            },
            success: function(data) {
                if (data.status === "success") {
                    $("#age").val(data.age || "");
                    $("#dob").val(data.dob || "");
                    $("#contact").val(data.contact || "");
                    $("#bio").val(data.bio || "");
                } else {
                    console.log("PROFILE LOAD FAILED", data.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("PROFILE LOAD ERROR", xhr.responseText || error);
            }
        });
    }

    // Check authentication from localStorage
    if (!checkAuthentication()) {
        return;
    }
    
    // Display user information
    $("#userEmail").text(email);
    $("#userName").text(name);
    loadProfileData();

    $("#saveProfileBtn").click(function(){
        let age = $("#age").val().trim();
        let contact = $("#contact").val().trim();
        let bio = $("#bio").val().trim();
        let dob = $("#dob").val().trim();

        if (age === '') {
            alert("Age is required.");
            return;
        }

        if (!/^[0-9]+$/.test(age) || Number(age) < 18 || Number(age) > 100) {
            alert("Age must be a number between 18 and 100.");
            return;
        }

        if (contact === '') {
            alert("Contact is required.");
            return;
        }

        if (!/^[0-9]{10}$/.test(contact)) {
            alert("Contact must be exactly 10 digits.");
            return;
        }

        if (bio.length > 200) {
            alert("Bio cannot exceed 200 characters.");
            return;
        }

        $.ajax({
            url: "php/save_profile.php",
            type: "POST",
            dataType: "json",
            data: {
                email: email,
                age: age,
                dob: dob,
                contact: contact,
                bio: bio
            },
            success: function(data){
                let alertClass = data.status === "success" ? "alert-success" : "alert-danger";
                $("#profileMessage").html(
                    '<div class="alert ' + alertClass + '">' +
                    (data.message || "Unable to save profile") +
                    '</div>'
                );
            },
            error: function(xhr, status, error){
                console.log("PROFILE SAVE ERROR", xhr.responseText || error);
                $("#profileMessage").html(
                    '<div class="alert alert-danger">Unable to save profile. Please try again.</div>'
                );
            }
        });
    });

    $("#logoutBtn").click(function(){
        // Clear all localStorage authentication data
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('userEmail');
        localStorage.removeItem('userName');
        localStorage.removeItem('userId');
        
        // Redirect to login page
        window.location.href = "login.html";
    });
});
