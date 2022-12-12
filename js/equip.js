$(function(){
    $("#submit_equip").click(function(){
        let equip_name = ($("#nome_equip").val().toString());
        let ip_equip = ($("#ip_equip").val().toString());
        let user_equip = ($("#user_equip").val().toString());
        check_output(equip_name, ip_equip, user_equip);
    });
});


function check_output(name, ip, username){
    /*
    Function to check the HTML form output.
    */
    if(name.length === 0) {
        console.log("Nome Vazio!");
        window.alert("Nome Vazio!");
    }else if(ip.length === 0){
        console.log("IP/Nome Vazio!");
        window.alert("IP/Nome Vazio!");
    }else if(username.length === 0){
        console.log("Username Vazio!");
        window.alert("Username Vazio!");
    }
}