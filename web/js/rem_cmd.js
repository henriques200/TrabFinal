$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './get_cmd.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    console.log(data.message[row]);
                    var content = `<option value ="${data.message[row].Nome_codigo}">${data.message[row].Nome_codigo} - ${data.message[row].Comando}</option>`;
                    $("#select_cmd").append(content);
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
        var codename = $("#select_cmd option:selected").val().toString();

        //Check if post content is empty.
        if(codename.length === 0 || codename === "Escolhe...") {
            alert("Introduz um nome válido!");
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: './remove_cmd.php',
                data: $('#select_cmd').serializeArray(),
                dataType: "json",
                encode: true,
                cache: false,
                beforeSend: function () {
                    //We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $('#sub_rem_cmd').attr("disabled", true);
                },
                success: function(data){
                    console.log(data); //Para fins de diagnóstico.
                    if(data.error === 1) window.alert ("Erro!\n" + data.message);
                    else window.alert("Comando eliminado com sucesso!");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    window.alert("Erro nos dados submetidos!");
                    console.log(jqXHR); //Para fins de diagnóstico.
                    console.log(textStatus); //Para fins de diagnóstico.
                    console.log(errorThrown.toString()); //Para fins de diagnóstico.
                },
                complete: function(){
                    $("#select_cmd option:selected").remove();
                    $("#remove_cmd").trigger("reset");
                    $("#sub_rem_cmd").attr("disabled", false);
                }
            });
            e.preventDefault();
            return false;
        }
    });
});