function getValues(){
	for( var i = 1; i < $("tr").length; i++){
		$("#formgid" + i).val(i);
		$("#formnimi" + i).val($("#nimi" + i).text());
		$("#formid" + i).val($("#id" + i).text());
		$("#formemail" + i).val($("#email" + i).text());
		$("#formakt" + i).val($("#akt" + i).text());
	}
}

$(document).ready(function() {
	getValues();
});