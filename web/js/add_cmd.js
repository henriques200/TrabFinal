$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './get_os.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                //console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message[row].Nome);
                    var content = `<option value ="${data.message[row].Nome}">${data.message[row].Nome}</option>`;
                    $("#opt_os").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados!");
            }
        });
        return false;
    });
    $("form").submit(function(e){
        //Fetch the required form data.
        var opt_os = $("#opt_os option:selected").val().toString();
        var codename = $("#codename").val().toString();
        var cmd = $("#cmd").val().toString();
        var cmd_desc = $("#cmd_desc").val().toString();

        //Check if post content is empty.
        if(codename.length === 0){
            alert("Introduz um código do comando!");
            e.preventDefault();
            return false;
        } else if(cmd.length === 0){
            alert("Introduz um comando!");
            e.preventDefault();
            return false;
        } else if(opt_os.length === 0 || opt_os === "Escolhe...") {
            alert("Introduz um SO válido!");
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: './submit_cmd.php',
                data: $('#add_new_cmd').serializeArray(),
                dataType: "json",
                encode: true,
                cache: false,
                beforeSend: function () {
                    //We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $('#submit_cmd').attr("disabled", true);
                },
                success: function(data){
                    console.log(data); //Para fins de diagnóstico.
                    if(data.error === 1) window.alert ("Erro!\n" + data.message);
                    else window.alert("Comando adicionado com sucesso!");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    window.alert("Erro nos dados submetidos!");
                    console.log(jqXHR); //Para fins de diagnóstico.
                    console.log(textStatus); //Para fins de diagnóstico.
                    console.log(errorThrown.toString()); //Para fins de diagnóstico.
                },
                complete: function(){
                    $("#add_new_cmd").trigger("reset");
                    $("#submit_cmd").attr("disabled", false);
                }
            });
            e.preventDefault();
            return false;
        }
    });
});