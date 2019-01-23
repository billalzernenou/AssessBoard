//bootstrap-select compatible with version 4
//$.fn.selectpicker.Constructor.BootstrapVersion = '4';

//responsive
function resizePage()
{
	var width = $(window).width();
	if(width < 993) {
		$(".col-sm-7").removeClass("col-sm-7").addClass("col");
		$(".col-sm-8").removeClass("col-sm-8").addClass("col");
	}else{
		$(".col").removeClass("col").addClass("col-sm-7");
		$(".col").removeClass("col").addClass("col-sm-8");
	}
}
$(window).resize(resizePage);
resizePage();

var room = 1;
//add UE
function insertRow() {
	room++;
	var objTo = document.getElementById('ue');
	var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group row justify-content-center removeclass"+room);
	var width;
	if($(window).width() < 993) {
		width = "col";
	}else{
		width = "col-sm-7";
	}
	divtest.innerHTML = '<div class='+width+'><input type="text" class="form-control" id="inputUE" name="UE'+room+'" placeholder="UE" required></div><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="Cours[]" value="'+room+'"><label class="form-check-label" for="inlineCheckbox1">Cours</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="TD[]" value="'+room+'"><label class="form-check-label" for="inlineCheckbox1">TD</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="TP[]" value="'+room+'"><label class="form-check-label" for="inlineCheckbox1">TP</label></div><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="removeRow('+ room +');"><i class="fa fa-minus"></i></button></div><div class="clear"></div>';
	objTo.appendChild(divtest);
}

//remove UE
function removeRow(rid) {
	$('.removeclass'+rid).remove();
	room--;
}

$('#customFile').on('change',function(e){
	//get the file name
	var fileName = e.target.files[0].name;
	//replace the "Choose a file" label
	$(this).next('.custom-file-label').html(fileName);
});