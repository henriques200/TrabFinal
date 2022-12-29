$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './list_os.php',
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
});