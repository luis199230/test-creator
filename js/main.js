$(document).ready(function() {
	initAuthor();
	if($('#teacher').length!=0){
		createQuestions();
	}else{
		showQuestions();
	}
});

function showQuestions(){
	var timer = new Timer({
	tick : 1,
	ontick : function (sec) {
	    	min=parseInt(sec/60);
	        sec=sec%60;
		    $("#num-min").html(min);
		    $("#num-sec").html(sec);	
	    }
	});
	timer.on('end', function () {
		$("#num-min").html(0);
		$("#num-sec").html(0);
		$(location).attr('href','exam.php');
	});
	timer.start($("#num-min").text()*60);
	$('#save-exam').submit(function(e){
		e.preventDefault();
		$('#finish').prop( "disabled", true );
		nbad=0
		ngood=0;	
		$('.preg').each(function(j){
			var cont=[];
			var rpta=[];
			$('.preg-'+(j+1)).each(function(i){
				if($(this).is(':checked')){
					cont[i]=1;
				}else{
					cont[i]=0;
				}
				if($(this).val()==1){
					rpta[i]=1;
				}else{
					rpta[i]=0;
				}
			});
			r=0;
			for(m=0;m<cont.length;m++){
				if(cont[m]==rpta[m]){
					r++;
				}
			}
			if(r==m){
				$(this).css("background","#5882FA");
				ngood++;
			}else{
				$(this).css("background","#FA5858");
			}
			cont.length = 0;
			rpta.length = 0;
			nbad=j+1;
		});
		porcent=(ngood/nbad)*100;
		if(porcent>70){
			alert("Aprobo el examen!"+porcent);
		}else{
			alert("Desaprobo el examen!"+porcent);
		}

	});
}

function createQuestions(){
	$('#showpreguntas').click(function(){
		npreguntas = $('#npreguntasc').val();
		if(npreguntas>0){
			msg = '<p>Ingrese las preguntas correspondientes:</p>';
			opc0 = '<option value="0">Seleccione ...</option>'
			opc1 = '<option value="1">Radio Buttom</option>';
			opc2 = '<option value="2">Check Box</option>';
			typepreg = '<select name="opt-preg[]" class="showalternativas">'+opc0+opc1+opc2+'</select>';
				
			$('.preguntas').html(msg);	
			for(i=0;i<npreguntas;i++){
				preg = '<input type="text" size="120" name="preg[]" placeholder="Pregunta '+(i+1)+'"/>'
				line = '<div class="question '+(i+1)+'">'+typepreg+preg+'<div class="answer-'+(i+1)+'"></div></div>';
				$('.preguntas').append(line);
			}
			$('#save').prop('disabled', false);;
		}else{
			$('#npreguntasc').focus();
		}
		$('.showalternativas').change(function(){
			npreg = $(this).parent().find('div').attr('class');
			npreg=npreg.replace("answer-","");

			msg='<p>Ingrese las alternativas</p>';
			if($(this).val()==0){
				$(this).parent().find('div').empty();
			}
			if($(this).val()==1){
				$(this).removeAttr('style');
				$(this).parent().find('div').html(msg+showAnswer(1,1,npreg)+showAnswer(1,2,npreg));
			}
			if($(this).val()==2){
				$(this).removeAttr('style');
				$(this).parent().find('div').html(msg+showAnswer(2,1,npreg)+showAnswer(2,2,npreg)+showAnswer(2,3,npreg)+showAnswer(2,4,npreg));			
			}
		});
	});

	$('#questions-answers').submit(function(e){
		valid=0;
		if($('#npreguntass').val()=='' || $('#npreguntass').val()>$('#npreguntasc').val()){
			$('#npreguntass').focus();
		}else{
			valid++;
		}
		$('.showalternativas').each(function(i){
			if($(this).val()==0){
				$(this).css('background','#F6CECE');
				valid--;	
			}else{
				$(this).removeAttr('style');	
			}
		});
		$('.question').each(function(i){
			if($(this).find('input').val()==''){
				$(this).find('input').css('background','#F6CECE');
				valid--;
			}else{
				$(this).find('input').removeAttr('style');	
			}

			$(this).find('div').find('input').each(function(j){
				if($(this).val()==''){
					$(this).css('background','#F6CECE');
					valid--;
				}else{
					$(this).removeAttr('style');
				} 
			});
		});
		if(valid<1){
     		e.preventDefault();
    	}
	});
}

function initAuthor(){
	$('#footer').text('Created by Luis Benavides Acevedo');
}

function showAnswer(type,j,npreg){
	if(type==1){ 
		type="radio";
	}else{ 
		type="checkbox";
	}
	answer='<input class="rpta" type="'+type+'" name="ropt'+npreg+'[]" value="'+j+'">';

	answer+= '<input type="text" size="30" placeholder="opcion: '+j+'" name="answer'+npreg+'[]"/>'
	return answer;
}

function validar(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    patron = /\d/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
} 
