<?php 
function current_url()
{
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    return $validURL;
}
$url = current_url();
$inimesed_url = str_replace('sunnipaevaplugin','inimesed',$url);
$muudagrupp_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$lisagrupp_url = str_replace('sunnipaevaplugin','lisagrupp',$url);
?>
<h1 class="h1 text-center my-4">Grupid</h1>
<div  class="text-center my-2"><a  href=<?php echo $lisagrupp_url;?>><button class="btn btn-info mx-auto mb-3 border-0">+ Lisa grupp</button></a></div>
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
    <td class="p-2"><a href="<?php echo $inimesed_url;?>" class="text-info">Grupp 1</a></td>
	<td class="p-2">AK</td>
    <td class="p-2">ut.ak@lists.ut.ee</td>
    <td class="p-2">Jah</td>
<td class="p-2">
<div class="btn-group">
    <form method="post" action=<?php echo $muudagrupp_url;?>><input value="Muuda" type="submit" class="btn btn-info btn-sm border-0 d-block"></form>
	 <button type="button" class="btn btn-primary delete border-0 btn-danger btn-sm">Kustuta</button>
</div>
</td>
  </tr>
  <tr>
  <td class="p-2">2</td>
    <td class="p-2"><a href=<?php echo $inimesed_url;?> class="text-info">Grupp 2</a></td>
	<td class="p-2">MTAT</td>
    <td class="p-2">ut.mtat@lists.ut.ee</td>
    <td class="p-2">Jah</td>
<td class="p-2">
 <div class="btn-group">
    <form method="post" action=<?php echo $muudagrupp_url;?>><input value="Muuda" type="submit" class="btn btn-info btn-sm border-0 d-block"></form>
	 <button type="button" class="btn btn-danger btn-sm delete border-0">Kustuta</button>
</div>
</td>
</tr>
<tr>
<td class="p-2">3</td>
    <td class="p-2"><a href=<?php echo $inimesed_url;?> class="text-info">Grupp 3</a></td>
	<td class="p-2">LTAT</td>
    <td class="p-2">ut.ltat@lists.ut.ee</td>
    <td class="p-2">Jah</td>
<td class="p-2">
<div class="btn-group">
    <form method="post" action=<?php echo $muudagrupp_url;?>><input value="Muuda" type="submit" class="btn btn-info btn-sm edit border-0 d-block"></form>
	 <button type="button" class="btn btn-danger btn-sm delete border-0">Kustuta</button>
</div>
</td>
</tr>
</tbody>
</table>