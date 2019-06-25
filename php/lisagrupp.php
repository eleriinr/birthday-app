<?php $url = str_replace('lisagrupp', 'sunnipaevaplugin',$url);?>

<h1 class="h1 text-center my-4" >Lisa grupp</h1>
<div style="text-align:center;"><a href=<?php echo $url; ?>><button class="btn btn-danger">Tagasi</button></a></div>

<?php echo '<form action=' . $url . ' method="post">';?>
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
  <input value="Lisa" type="submit" class="btn btn-info mx-auto mb-3 d-block"> 
</form>