function getValues(){
	for( var i = 1; i < $("tr").length; i++){
		$("#formfname" + i).val($("#fname" + i).text());
		$("#formlname" + i).val($("#lname" + i).text());
		var kp = $("#kp" + i).text().split(".");
		$("#formkp" + i).val(kp[2] + "-" + kp[1] + "-" + kp[0]);
		$("#formemail" + i).val($("#email" + i).text());
		$("#formemails" + i).val($("#emails" + i).text());
		$("#formgid" + i).val(parseInt($("#gid" + i).text(),10));
		$("#formakt" + i).val($("#akt" + i).text());
	}
}

$(document).ready(function() {
	getValues();
});