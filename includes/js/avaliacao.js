jQuery(document).ready(function(){
	var average = jQuery('.ratingAverage').attr('data-average');
	function avaliacao(average){
		average = (Number(average)*20);
		jQuery('.bg').css('width', 0);		
		jQuery('.barra .bg').animate({width:average+'%'}, 500);
	}
	
	avaliacao(average);

	jQuery('.star').on('mouseover', function(){
		var indexAtual = jQuery('.star').index(this);
		for(var i=0; i<= indexAtual; i++){
			jQuery('.star:eq('+i+')').addClass('full');
		}
	});
	jQuery('.star').on('mouseout', function(){
		jQuery('.star').removeClass('full');
	});

	jQuery('.star').on('click', function(){
		var idArticle = jQuery('.article').attr('data-id');
		var voto = jQuery(this).attr('data-vote');
		jQuery.post('sys/votar.php', {votar: 'sim', artigo: idArticle, ponto: voto}, function(retorno){
			avaliacao(retorno.average);
			jQuery('.votos span').html(retorno.votos);
		}, 'jSON');
	});
});