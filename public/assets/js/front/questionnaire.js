$('form').submit(function (e) {
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
});