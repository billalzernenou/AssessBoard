// Align checkboxes
$('.form-check').addClass('form-check-inline');

// On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
var $container = $('div#questionnaire_ues');

// On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
var index = $container.find(':input').length;

// On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
$('#add_ue').click(function(e) {
	addUE($container);
	e.preventDefault(); // évite qu'un # apparaisse dans l'URL
	return false;
});

// On ajoute un premier champ automatiquement s'il n'en existe pas déjà un.
if (index == 0) {
	addUE($container);
} else {
	// S'il existe déjà des ues, on ajoute un lien de suppression pour chacune d'entre elles
	$container.children('div').each(function() {
		addDeleteLink($(this));
	});
}

// La fonction qui ajoute un formulaire UEType
function addUE($container) {
	// Dans le contenu de l'attribut « data-prototype », on remplace :
	// - le texte "__name__label__" qu'il contient par le label du champ
	// - le texte "__name__" qu'il contient par le numéro du champ
	var template = $container.attr('data-prototype')
		.replace(/__name__label__/g, 'UE' + (index+1))
        .replace(/__name__/g, index)
	;

	// On crée un objet jquery qui contient ce template
	var $prototype = $(template);

	// On ajoute au prototype un lien pour pouvoir supprimer la catégorie
	addDeleteLink($prototype);

	// On ajoute le prototype modifié à la fin de la balise <div>
	$container.append($prototype);

	// Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
	index++;
}

// La fonction qui ajoute un lien de suppression d'une catégorie
function addDeleteLink($prototype) {
	// Création du lien
	var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

	// Ajout du lien
	$prototype.append($deleteLink);

	// Ajout du listener sur le clic du lien pour effectivement supprimer la catégorie
	$deleteLink.click(function(e) {
        $prototype.remove();
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
	});
}

/// Display the file's name
$('#customFile').on('change',function(e){
	// Get the file name
	var fileName = e.target.files[0].name;
	// Replace the "Choose a file" label
	$(this).next('.custom-file-label').html(fileName);
});

// Check the file's extension
function fileValidation(){
	// Get the file name, possibly with path (depends on browser)
	var fileInput = $('#customFile');
    var filePath = fileInput.val();
    var allowedExtensions = /(\.csv|\.xlsx)$/i;
    if(!allowedExtensions.exec(filePath)){
        $('.custom-file .invalid-feedback').css("display","block");
        fileInput.value = '';
        return false;
    }else{
    	$('.custom-file .invalid-feedback').css("display","none");
    	return true;
    }
}

$('form').submit(function (e) {
	
	if (fileValidation()) {
		$("div[id^=questionnaire_ues_]").each(function() {
		 	//check at least 1 checkbox is checked
			if (!$(this).find('input[type=checkbox]').is(':checked')){
				$(this).append('<div class="form-group"><div class="invalid-feedback">Veuillez cocher au moins une case</div></div>');
        		$(this).find('.invalid-feedback').css("display","block");
				//prevent the default form submit if it is not checked
				e.preventDefault();
        	}else{
        		$(this).find('.invalid-feedback').css("display","none");
        	}
		});
	} else {
		e.preventDefault();
	}
})