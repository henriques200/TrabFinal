$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './list_equip.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                console.log(data); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    //console.log(data.message[row]);
                    var content = "<tr><td>" + data.message[row].Nome + "</td><td>" + data.message[row].Ip_Nome +"</td><td>" + data.message[row].OS +"</td><td>" + data.message[row].Grupo +"</td></tr>";
                    $("#table_body").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados!");
            }
        });
        return false;
    });
});