
let user = localStorage.getItem("user");

if(user == null){

    window.location.href = "login.html";

}
$("#userEmail").html(localStorage.getItem("user"));
console.log($("#userEmail").length);
$(document).ready(function(){
    $("#userEmail").text(
        localStorage.getItem("user")
    );

    $("#saveProfileBtn").click(function(){
        let email=localStorage.getItem("user");
        let age=$("#age").val();
        let contact=$("#contact").val();
        let bio=$("#bio").val();

        $.ajax({

            url: "php/save_profile.php",

            type: "POST",

            data:{
                email:email,
                age:age,
                contact:contact,
                bio:bio

            },

            success:function(response){
                $("#profileMessage").html(
                    '<div class="alert alert-success">' +
                    response +
                    '</div>'
                );

            },

            error:function(xhr,status,error){

                alert("AJAX ERROR");

            }

        });

    });
$("#logoutBtn").click(function(){

    localStorage.removeItem("user");

    window.location.href = "login.html";
});
});

