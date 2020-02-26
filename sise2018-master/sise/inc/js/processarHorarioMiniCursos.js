function processarHorario(){
    var eventos = document.getElementsByClassName("checkJS");
    var eventosMarcados = new Array();
    for (i=0; i < eventos.length; i++) {
        if (eventos[i].checked){
            eventosMarcados.push(eventos[i]);
        }
    }

    var passou = true;
    console.log(eventosMarcados.length);
    for (i=0; i < eventosMarcados.length - 1; i++) {
        for (j=(i+1); j < eventosMarcados.length; j++) {
            var dataI = document.getElementById("d"+eventosMarcados[i].value);
            var horaI = document.getElementById("h"+eventosMarcados[i].value);

            var dataJ = document.getElementById("d"+eventosMarcados[j].value);
            var horaJ = document.getElementById("h"+eventosMarcados[j].value);

            console.log(dataI.innerHTML + " - " + horaI.innerHTML);
            console.log(dataJ.innerHTML + " - " + horaJ.innerHTML);

            if (dataI.innerHTML == dataJ.innerHTML && horaI.innerHTML == horaJ.innerHTML) {
                passou = false;
            }
        }
    }

    var botaoEnviar = document.getElementById("enviar");
    var mensagem = document.getElementById("mensagem");

    if (!passou) {
        botaoEnviar.style = "display: none;";
        mensagem.style = "display: block;";
    } else {
        botaoEnviar.style = "display: block;";
        mensagem.style = "display: none;";
    }
}