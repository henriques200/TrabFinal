$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './get_equip.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                //console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message[row].Nome);
                    var content = `<option value ="${data.message[row].Nome}">${data.message[row].Nome} - ${data.message[row].Ip_Nome}</option>`;
                    $("#select_equip").append(content);
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
        var group_name = $("#select_equip option:selected").val().toString();

        //Check if post content is empty.
        if(group_name.length === 0 || group_name === "Escolhe...") {
            alert("Introduz um nome válido!");
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: './remove_equip.php',
                data: $('#select_equip').serializeArray(),
                dataType: "json",
                encode: true,
                cache: false,
                beforeSend: function () {
                    //We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $('#sub_rem_equip').attr("disabled", true);
                },
                success: function(data){
                    console.log(data); //Para fins de diagnóstico.
                    if(data.error === 1) window.alert ("Erro!\n" + data.message);
                    else window.alert("Equipamento eliminado com sucesso!");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    window.alert("Erro nos dados submetidos!");
                    console.log(jqXHR); //Para fins de diagnóstico.
                    console.log(textStatus); //Para fins de diagnóstico.
                    console.log(errorThrown.toString()); //Para fins de diagnóstico.
                },
                complete: function(){
                    $("#select_equip option:selected").remove();
                    $("#remove_equip").trigger("reset");
                    $("#sub_rem_equip").attr("disabled", false);
                }
            });
            e.preventDefault();
            return false;
        }
    });
});