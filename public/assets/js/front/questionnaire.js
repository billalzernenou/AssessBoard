$(document).ready(function(){
	$(".ue").first().find(".previous").remove();
	$(".ue").last().find(".next").remove();
	$(".ue").last().append('<input type="submit" name="submit" class="submit btn btn-success" value="Envoyer" />');
	var current = 1,current_step,next_step,steps;
	steps = $(".ue").length;
	$(".next").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().next();
		next_step.show();
		current_step.hide();
		setProgressBar(++current);
	});
	$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep){
		var percent = parseFloat(100 / (steps+1)) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width",percent+"%")
			.html(percent+"%");   
	}
});



/*$('form').submit(function (e) {
//$('button[type="button"]').click(function (e) {
		var id = '{{ id | json_encode | raw }}';
		var answers = { data: [] };

    	$("div[id*='ue_']").each(function (){
			var ue = $(this).attr('id').substring(3);
			$(this).find("div[id='answers']").each(function (index){
				var question = $(this).find('p').attr('id');
				var radioValue = $("input[name='ue_"+ue+"_group"+(index+1)+"']:checked").val();
				var answer = {ue: ue, question: question, radioValue: radioValue};
				answers.data.push(answer);
			});
		});

		console.log(answers);

       	$.ajax({
        	type: 'POST',
		    dataType : "json",
		    url: "{{ path('questionnaire', { 'id': id }) }}",
		    contentType: 'application/json; charset=utf-8',
        	data: JSON.stringify(answers),
		    success: function(msg){
		        alert("OK! ");
		    },
		    error: function(XmlHttpRequest,textStatus, errorThrown){
		        alert("Failed! ");
		    }
        });
});*/