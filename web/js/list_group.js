$(function(){
    $(document).ready(function(e){
        $.ajax({
            type: 'POST',
            url: './list_group.php',
            data: $('#list_group').serializeArray(),
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                console.log(data); //Para fins de diagnóstico.
                console.log(data.message); //Para fins de diagnóstico.
                for(var row = 0; row < data.message.length; row++){
                    console.log(data.message[row].Nome);
                    var content = "<tr><td>" + data.message[row].Nome + "</td><td>" + data.message[row].Dono +"</td><td>" + data.message[row].Phone +"</td><td>" + data.message[row].NIF +"</td></tr>";
                    $("#table_body").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro nos dados submetidos!");
            }
        });
        return false;
    });
});