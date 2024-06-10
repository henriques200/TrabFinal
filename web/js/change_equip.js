$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './code/get_os.php',
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
                window.alert("Erro ao adquirir dados sobre os OS's!");
            }
        });
        $.ajax({
            url: './code/get_group.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                //console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message[row].Nome);
                    var content = `<option value ="${data.message[row].Nome}">${data.message[row].Nome}</option>`;
                    $("#select_group").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição dos grupos!");
            }
        });
        $.ajax({
            url: './code/get_equip.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message);
                    var content = `<option value ="${data.message[row].Nome}">${data.message[row].Nome} - ${data.message[row].Ip_Nome}</option>`;
                    $("#select_equip").append(content);
                }
                $("#select_equip").change(function(){
                    for(var row = 0; row < data.message.length; row++){
                        if(data.message[row].Nome === $(this).val()){
                            $("#nome_equip").val(data.message[row].Nome);
                            $("#ip_equip").val(data.message[row].Ip_Nome);
                            $("#opt_os").val(data.message[row].OS);
                            $("#select_group").val(data.message[row].Grupo);
                        }
                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados!");
            }
        });
        return false;
    });
    $("form").submit(function(e){
        //Fetch the required form data.
        var equip_name = $("#select_equip option:selected").val().toString();
        var ip_equip = $("#ip_equip").val().toString();
        var user_equip = $("#user_equip").val().toString();
        var pass_equip = $("#pass_equip").val().toString();
        var opt_os = $("#opt_os option:selected").val().toString();
        var group = $("#select_group option:selected").val().toString();

        //Check if post content is empty.
        if(equip_name.length === 0){
            alert("Introduz o nome do equipamento!");
            e.preventDefault();
            return false;
        } else if(ip_equip.length === 0){
            alert("Introduz o endereço ou nome do equipamento!");
            e.preventDefault();
            return false;
        } else if(user_equip.length === 0){
            alert("Introduz o username do equipamento!");
            e.preventDefault();
            return false;
        } else if(pass_equip.length === 0){
            alert("Introduz uma palavra passe!");
            e.preventDefault();
            return false;
        } else if(opt_os.length === 0 || opt_os === "Escolhe...") {
            alert("Introduz um SO válido!");
            e.preventDefault();
            return false;
        } else if(group.length === 0 || group === "Escolhe..."){
            alert("Introduz um grupo válido!");
            e.preventDefault();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: './code/change_equip.php',
                data: $('#edit_equip').serializeArray(),
                dataType: "json",
                encode: true,
                cache: false,
                beforeSend: function () {
                    //We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $('#sub_edit_equip').attr("disabled", true);
                },
                success: function(data){
                    console.log(data); //Para fins de diagnóstico.
                    if(data.error === 1) window.alert ("Erro!\n" + data.message);
                    else window.alert("Equipamento editado com sucesso!");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    window.alert("Erro nos dados submetidos!");
                    console.log(jqXHR); //Para fins de diagnóstico.
                    console.log(textStatus); //Para fins de diagnóstico.
                    console.log(errorThrown.toString()); //Para fins de diagnóstico.
                    console.log($('#edit_equip').serializeArray());
                    console.log($("#select_equip option:selected").val().toString());
                },
                complete: function(){
                    $("#edit_equip").trigger("reset");
                    $("#sub_edit_equip").attr("disabled", false);
                }
            });
            e.preventDefault();
            return false;
        }
    });
});