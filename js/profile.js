let user = localStorage.getItem("user");
if(user == null){
    window.location.href = "login.html";
}
$(document).ready(function(){
    let email = localStorage.getItem("user");
    let name = localStorage.getItem("name");
    document.getElementById("userName").innerHTML = name;
    document.getElementById("userEmail").innerHTML = email;
});
if(user == null){
    window.location.href = "login.html";
}
$(document).ready(function(){
    let email = localStorage.getItem("user");
    let name = localStorage.getItem("name");
    $("#userEmail").text(email);
    $("#userName").text(name);
    $("#saveProfileBtn").click(function(){
        let age = $("#age").val();
        let contact = $("#contact").val();
        let bio = $("#bio").val();
        let dob = $("#dob").val();
        $.ajax({
            url:"php/save_profile.php",
            type:"POST",
            data:{
                email:email,
                age:age,
                dob:dob,
                contact:contact,
                bio:bio
            },
            success:function(response){
                $("#profileMessage").html(
                    '<div class="alert alert-success">'+
                    response+
                    '</div>'
                );
            },
            error:function(){
                alert("AJAX ERROR");
            }
        });
    });
    $("#logoutBtn").click(function(){
        $.ajax({
            url:"php/logout.php",
            type:"POST",
            data:{
                email:email
            },
            success:function(response){
                localStorage.removeItem("user");
                localStorage.removeItem("name");
                window.location.href="login.html";
            },
            error:function(xhr,status,error){
            }
        });
    });

});