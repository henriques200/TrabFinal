$(function(){
    $(document).ready(function(e){
        $.ajax({
            url: './events.php',
            dataType: "json",
            encode: true,
            cache: false,
            success: function(data){
                console.log(data); //Para fins de diagnóstico.
                latest_events = data.message.reverse();
                if(latest_events.length > 10) latest_events_length = 10
                else latest_events_length = latest_events.length;

                for(var row = 0; row < latest_events_length; row++){
                    var content = '<p><span style="font-weight:bold">' + data.message[row].time + "</span> [" + data.message[row].type + "] " + data.message[row].descr +"</p>";
                    $("#events").append(content);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                window.alert("Erro na aquisição de dados!");
            }
        });
        return false;
    });
});