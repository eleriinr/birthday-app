<?php 
$lisaisik_url = str_replace('inimesed','lisainimene',$url);
$muudaisik_url = str_replace('inimesed','muudainimene',$url);
$url = str_replace('inimesed', 'sunnipaevaplugin',$url);
?>

<h1 class="h1 text-center my-4">Isikud</h1>
<div style="text-align:center;"><a href=<?php echo $url; ?>><button class="btn btn-danger">Tagasi</button></a></div>
<div  class="text-center my-2"><a href=<?php echo $lisaisik_url;?>><button class="btn btn-info mx-auto mb-3">+ Lisa inimene</button></a></div>
<table class="table-striped table-hover border-0 mx-auto text-center">
<thead>
  <tr>
    <th class="p-2">Eesnimi</th>
    <th class="p-2">Perenimi</th>
    <th class="p-2">Kuupäev</th>
    <th class="p-2">Email</th>
    <th class="p-2">Emaili saaja</th>
	<th class="p-2">Grupi ID</th>
	<th class="p-2">Aktiivne</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="p-2" id="fname1">Eleriin</td>
    <td class="p-2" id="lname1">Rein</td>
    <td class="p-2" id="kp1">13.08.1998</td>
    <td class="p-2" id="email1"><nobr>eleriin.r@gmail.com<nobr></td>
    <td class="p-2" id="emails1"></td>
    <td class="p-2" id="gid1">2</td>	
	<td class="p-2" id="akt1">Jah</td>
    <td class="p-2">
      <div class="btn-group">
    <form method="post" action=<?php echo $muudaisik_url;?>>
		<input id="formfname1" name="eesnimi" type="text" hidden>
		<input id="formlname1" name="perenimi" type="text" hidden>
		<input id="formkp1" name="kuupaev" type="date" hidden>
		<input id="formemail1" name="email" type="email" hidden>
		<input id="formemails1" name="emails" type="email" hidden>
		<input id="formgid1" name="grupi_id" type="number" hidden>
		<input id="formakt1" name="aktiivne" type="text" hidden>
		<input value="Muuda" type="submit" class="btn btn-info btn-sm">
	</form>
	<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
	  </div>
    </td>
  </tr>
  <tr>
    <td class="p-2" id="fname2">Toomas</td>
    <td class="p-2" id="lname2">Petersell</td>
    <td class="p-2" id="kp2">31.10.1963</td>
    <td class="p-2" id="email2"><nobr>toomas.petersell@ut.ee</nobr></td>
    <td class="p-2" id="emails2">sekre.tar@ut.ee</td>
	<td class="p-2" id="gid2">1</td>
	<td class="p-2" id="akt2">Ei</td>
    <td class="p-2">
      <div class="btn-group">
 <form method="post" action=<?php echo $muudaisik_url;?>>
		<input id="formfname2" name="eesnimi" type="text" hidden>
		<input id="formlname2" name="perenimi" type="text" hidden>
		<input id="formkp2" name="kuupaev" type="date" hidden>
		<input id="formemail2" name="email" type="email" hidden>
		<input id="formemails2" name="emails" type="email" hidden>
		<input id="formgid2" name="grupi_id" type="number" hidden>
		<input id="formakt2" name="aktiivne" type="text" hidden>
		<input value="Muuda" type="submit" class="btn btn-info btn-sm">
	</form>		<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
	  </div>
    </td>
  </tr>
</tbody>
</table>
<script>
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
});</script>