<h1 class="h1 text-center my-4" >Lisa grupp</h1>
<?php 
function current_url()
{
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    return $validURL;
}
$url = current_url();
$url = str_replace('lisagrupp', 'sunnipaevaplugin',$url);
echo '<form action=' . $url . ' method="post">';
?>
  <div class="form-group w-25" style="margin:auto;">
  <label for="grupi_id">Grupi ID: </label>
  <input class="form-control" id="grupi_id" type="number" readonly>
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="nimi">Nimi: </label>
  <input class="form-control" id="nimi" type="text" placeholder="Nimi">
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="struktuuri_id">Struktuuri ID: </label>
  <input class="form-control" id="struktuuri_id" type="text" placeholder="ID">
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="email">Üldmeil: </label>
  <input class="form-control" id="email" type="email" placeholder="Email">
  </div>
 <div class="form-group text-center my-2">
 <label class="form-check-label" for="aktiivne">Aktiivne</label>
 <input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne">
  </div>
  <input value="Lisa" type="submit" class="btn btn-info mx-auto mb-3 border-0 d-block"> 
</form>