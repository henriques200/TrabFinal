$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './code/get_equip.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                //console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message[row].Nome);
                    var content = `<option value ="${data.message[row].Ip_Nome}" data-filter="${data.message[row].OS}">${data.message[row].Nome} - ${data.message[row].Ip_Nome} - ${data.message[row].OS}</option>`;
                    $("#opt_equip").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados dos equipamentos!");
            }
        });
        $.ajax({
            url: './code/get_cmd.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                //console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message[row].Nome);
                    var content = `<option value ="${data.message[row].Nome_codigo}">${data.message[row].Nome_codigo} - ${data.message[row].Comando}</option>`;
                    $("#opt_cmd").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados dos comandos!");
            }
        });
        return false;
    });
    $("#opt_equip").on("change", function(){
        var filter_value = $(this).val();
        $("#opt_cmd option").each(function(){
            var opt_filter = $(this).data('filter');
            if(opt_filter === filter_value) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $("form").submit(function(e){
        //Fetch the required form data.
        var opt_equip = $("#opt_equip option:selected").val().toString();
        var opt_cmd = $("#opt_cmd option:selected").val().toString();

        //Check if post content is empty.
        if(opt_equip.length === 0 || opt_equip === "Escolhe...") {
            alert("Introduz um equipamento válido!");
            e.preventDefault();
            return false;
        } else if(opt_cmd.length === 0 || opt_cmd === "Escolhe...") {
            alert("Introduz um comando válido!");
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: './code/run_cmd.php',
                data: $('#run_cmd').serializeArray(),
                dataType: "json",
                encode: true,
                cache: false,
                beforeSend: function () {
                    //We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $('#submit_run_cmd').attr("disabled", true);
                },
                success: function(data){
                    console.log(data); //Para fins de diagnóstico.
                    if(data.error === 1) window.alert ("Erro!\n" + data.message);
                    else {
                        window.alert("Comando executado com sucesso!");
                        //$(#um-div-qualquer).append(data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    window.alert("Erro nos dados submetidos!");
                    console.log(jqXHR); //Para fins de diagnóstico.
                    console.log(textStatus); //Para fins de diagnóstico.
                    console.log(errorThrown.toString()); //Para fins de diagnóstico.
                },
                complete: function(){
                    //$("#run_cmd").trigger("reset");
                    $("#submit_run_cmd").attr("disabled", false);
                }
            });
            e.preventDefault();
            return false;
        }
    });
});