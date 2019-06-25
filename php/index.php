<?php 
$inimesed_url = str_replace('sunnipaevaplugin','inimesed',$url);
$muudagrupp_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$lisagrupp_url = str_replace('sunnipaevaplugin','lisagrupp',$url);
?>

<h1 class="h1 text-center my-4">Grupid</h1>
<div  class="text-center my-2"><a  href=<?php echo $lisagrupp_url;?>><button class="btn btn-info mx-auto mb-3">+ Lisa grupp</button></a></div>
<table class="table-striped table-hover border-0 mx-auto text-center">
<thead>
  <tr>
	<th class="p-2">ID</th>
    <th class="p-2">Nimi</th>
	<th class="p-2">Struktuurüksuse ID</th>
    <th class="p-2">Üldmeil</th>
    <th class="p-2">Aktiivne</th>
    <th class="p-2"></th>
  </tr>
  </thead>
  <tbody>
 <tr>
 <td class="p-2">1</td>
    <td class="p-2" id="nimi1"><a href="<?php echo $inimesed_url;?>" class="text-info">Grupp 1</a></td>
	<td class="p-2" id="id1">AK</td>
    <td class="p-2" id="email1">ut.ak@lists.ut.ee</td>
    <td class="p-2" id="akt1">Jah</td>
<td class="p-2">
<div class="btn-group">
    <form method="post" action=<?php echo $muudagrupp_url;?>>
		<input id="formgid1" name="grupi_id" type="number" hidden>
		<input id="formnimi1" name="nimi" type="text" hidden value="" >
		<input id="formid1" name="struktuuri_id" type="text" hidden value="">
		<input id="formemail1" name="email" type="email" hidden value="">
		<input id="formakt1" name="aktiivne" type="text" hidden>
		<input value="Muuda" type="submit" class="btn btn-info btn-sm">
	</form>
	<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
</div>
</td>
  </tr>
  <tr>
  <td class="p-2">2</td>
    <td class="p-2" id="nimi2"><a href=<?php echo $inimesed_url;?> class="text-info">Grupp 2</a></td>
	<td class="p-2" id="id2">MTAT</td>
    <td class="p-2" id="email2">ut.mtat@lists.ut.ee</td>
    <td class="p-2" id="akt2">Ei</td>
<td class="p-2">
 <div class="btn-group">
    <form method="post" action=<?php echo $muudagrupp_url;?>>
		<input id="formgid2" name="grupi_id" type="number" hidden>
		<input id="formnimi2" name="nimi" type="text" hidden>
		<input id="formid2" name="struktuuri_id" type="text" hidden>
		<input id="formemail2" name="email" type="email" hidden>
		<input id="formakt2" name="aktiivne" type="text" hidden>
		<input value="Muuda" type="submit" class="btn btn-info btn-sm">
	</form>
	<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
</div>
</td>
</tr>
<tr>
<td class="p-2">3</td>
    <td class="p-2" id="nimi3"><a href=<?php echo $inimesed_url;?> class="text-info">Grupp 3</a></td>
	<td class="p-2" id="id3">LTAT</td>
    <td class="p-2" id="email3">ut.ltat@lists.ut.ee</td>
    <td class="p-2" id="akt3">Jah</td>
<td class="p-2">
<div class="btn-group">
	<form method="post" action=<?php echo $muudagrupp_url;?>>
		<input id="formgid3" name="grupi_id" type="number" hidden>
		<input id="formnimi3" name="nimi" type="text" hidden>
		<input id="formid3" name="struktuuri_id" type="text" hidden>
		<input id="formemail3" name="email" type="email" hidden>
		<input id="formakt3" name="aktiivne" type="text" hidden>
		<input value="Muuda" type="submit" class="btn btn-info btn-sm">
	</form>
	<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
</div>
</td>
</tr>
</tbody>
</table>
<script>
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
});</script>