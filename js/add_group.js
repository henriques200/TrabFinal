$(function(){
    $("#submit_group").click(function(){
        var group_name = $("#nome_group").val().toString();
        var group_owner = $("#dono_group").val().toString();
        check_output(group_name, group_owner);
    });
});

function check_output(name, owner){
    /*
    Function to check the HTML form output.
    */
    if(name.length === 0) {
        console.log("Nome Vazio!");
        window.alert("Nome Vazio!");
    }else if(owner.length === 0){
        console.log("Introduz o nome do dono!");
        window.alert("Introduz o nome do dono!");
    }
}