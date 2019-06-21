<?php 
function current_url()
{
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    return $validURL;
}
$url = current_url();
$lisainimene_url = str_replace('inimesed','lisainimene',$url);
$muudainimene_url = str_replace('inimesed','muudainimene',$url);
?>
<h1 class="h1 text-center my-4">Isikud</h1>
<div  class="text-center my-2"><a href=<?php echo $lisainimene_url;?>><button class="btn btn-info mx-auto mb-3">+ Lisa inimene</button></a></div>
<table class="table-striped table-hover border-0 mx-auto text-center">
<thead>
  <tr>
    <th class="p-2">Eesnimi</th>
    <th class="p-2">Perenimi</th>
    <th class="p-2">Kuupäev</th>
    <th class="p-2">Email</th>
    <th class="p-2">Emaili saaja</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="p-2">Eleriin</td>
    <td class="p-2">Rein</td>
    <td class="p-2">13.08.1998</td>
    <td class="p-2"><nobr>eleriin.r@gmail.com<nobr></td>
    <td class="p-2"></td>
    <td class="p-2">
      <div class="btn-group">
    <form method="post" action=<?php echo $muudainimene_url;?>><input value="Muuda" type="submit" class="btn btn-info btn-sm"></form>
		<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
	  </div>
    </td>
  </tr>
  <tr>
    <td class="p-2">Toomas</td>
    <td class="p-2">Petersell</td>
    <td class="p-2">31.10.1963</td>
    <td class="p-2"><nobr>toomas.petersell@ut.ee</nobr></td>
    <td class="p-2">sekre.tar@ut.ee</td>
    <td class="p-2">
      <div class="btn-group">
    <form method="post" action=<?php echo $muudainimene_url;?>><input value="Muuda" type="submit" class="btn btn-info btn-sm"></form>
		<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
	  </div>
    </td>
  </tr>
</tbody>
</table>