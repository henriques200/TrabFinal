$(function(){
    $("form").submit(function(e){
        //Fetch the required form data.
        var group_name = $("#nome_group").val().toString();
        var group_owner = $("#dono_group").val().toString();
        var phone_number = $("#phone_number").val().toString();
        var nif = $("#nif").val().toString();

        //Check if post content is empty.
        if(group_name.length === 0) {
            alert("Nome Vazio!");
            e.preventDefault();
            return false;
        } else if(group_owner.length === 0) {
            alert("Introduz o nome do dono!");
            e.preventDefault();
            return false;
        } else if(phone_number.length === 0) {
            alert("Introduz o nº de telefone!");
            e.preventDefault();
            return false;
        } else if(nif.length === 0) {
            alert("Introduz o NIF!");
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: './submit_group.php',
                data: $('#submit_new_group').serializeArray(),
                dataType: "json",
                encode: true,
                cache: false,
                beforeSend: function () {
                    //We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $('#submit_group').attr("disabled", true);
                },
                success: function(data){
                    console.log(data); //Para fins de diagnóstico.
                    if(data.error === 1) window.alert ("Erro! O nome do grupo já existe!");
                    else window.alert("Dados submetidos!");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    window.alert("Erro nos dados submetidos!");
                },
                complete: function(){
                    $("#submit_new_group").trigger("reset");
                    $("#submit_group").attr("disabled", false);
                }
            });
            e.preventDefault();
            return false;
        }
    });
});