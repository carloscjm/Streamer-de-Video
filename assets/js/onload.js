
$( document ).ready(function() {
    
    
});

var tempo = new Number();

function openPopUp(caminho,atual)
{
    $('#conteudoModal').css('display','block');
    var html=`<div id='contador' style='display:none;position: fixed;z-index: 1;color: white;text-align: right;padding: 10px 20px 0px 20px;bottom: 60px;background-color: gray;border-radius: 5px;'>
                <p id='screen'>Proximo episodio começa em:</p>
            </div>
            <video style='position: fixed;right: 0;bottom: 0;min-width: 100%;min-height: 100%;' id='video' autoplay controls preload='auto' '>
              <source class='a' src='`+caminho+`' type="video/mp4"/>
            </video>`;
    var element = document.getElementById('conteudoModal');
    element.innerHTML = html;
    fimVideo(caminho,atual);
}

function fimVideo(caminho='',atual=0)       
{
    setTimeout(function()
    {
        console.log('teste:', document.getElementById("video").currentTime, document.getElementById("video").duration);
        if(document.getElementById("video").currentTime < document.getElementById("video").duration || document.getElementById("video").currentTime == 0)
        {
            console.log('caminho :', caminho);
            fimVideo(caminho,atual);
        }
        else 
        {
            console.log('caminho :', caminho);
            var caputuloName =  caminho.split("/");
            $.ajax({
                url: 'serie/updt_views',
                type: "post",
                dataType: "json",
                data: {capName:caputuloName[4]},
                success: function(json)
                {
                    
                }
            })
            tempo = 5;
            $('#contador').css('display','block');
            startCountdown();
            pantalla = document.getElementById("screen");

            window.setTimeout(function(){
                $( "#video" ).remove();
                window.setTimeout(function(){
                    $('#contador').css('display','none');
                    atual = atual+1;
                    caminhoVideo = document.getElementById('cap'+atual).attributes[2].value;
                    resultado = caminhoVideo.split("`");
                    var caminhoVideo = document.getElementById('cap'+atual).previousElementSibling.textContent
                    var html="<div id='contador' style='display:none;position: fixed;z-index: 1;color: white;text-align: right;padding: 10px 20px 0px 20px;bottom: 60px;background-color: gray;border-radius: 5px;'><p id='screen'>Proximo episodio começa em: </p></div><video style='position: fixed;right: 0;bottom: 0;min-width: 100%;min-height: 100%;' autoplay id='video' controls preload='auto'>  <source class='a' src='"+resultado[1]+"' type='video/mp4' /></video>";
                    $("#conteudoModal").append(html);
                    fimVideo(resultado[1],atual);
                 }, 1000);
             }, 5000);
        }
    }, 5000);
}
 


function startCountdown(){
    pantalla = document.getElementById("screen");
	// Se o tempo não for zerado
	if((tempo - 1) >= 0){

		// Pega a parte inteira dos minutos
		var min = parseInt(tempo/60);
		// Calcula os segundos restantes
		var seg = tempo%60;

		// Formata o número menor que dez, ex: 08, 07, ...
		if(min < 10){
			min = "0"+min;
			min = min.substr(0, 2);
		}
		if(seg <=9){
			seg = "0"+seg;
		}

		// Cria a variável para formatar no estilo hora/cronômetro
		horaImprimivel = '00:' + min + ':' + seg;
		//JQuery pra setar o valor
		$("#sessao").html(horaImprimivel);

		// Define que a função será executada novamente em 1000ms = 1 segundo
		setTimeout('startCountdown()',1000);

		// diminui o tempo
        tempo--;
        pantalla.innerHTML = "Proximo episódio em: "+tempo; 
	    // Quando o contador chegar a zero faz esta ação
	} 

}

function sessionUser(id='', nome='')
{
    $.ajax({
        url: 'user/salvaSession',
        type: "post",
        dataType: "json",
        data: {id:id, nome:nome},           
        success: function(json)
        {               
            window.open("/streamer/home", "_self"); 
         
        }
    })
}