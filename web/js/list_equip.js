$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './list.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                console.log(data); //Para fins de diagnóstico.
                /*for(var row = 0; row < data.message.length; row++){
                    console.log(data.message[row]);
                    var content = "<tr><td>" + data.message[row].Nome_codigo + "</td><td>" + data.message[row].Comando +"</td><td>" + data.message[row].Descricao +"</td><td>" + data.message[row].OS +"</td></tr>";
                    $("#table_body").append(content);
                }*/
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados!");
            }
        });
        return false;
    });
});