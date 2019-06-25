<h1 class="h1 text-center my-4" >Muuda isik</h1>
<?php 
$url = str_replace('muudainimene', 'inimesed',$url);
echo '<form action=' . $url . ' method="post">';
?>
  <div class="form-group w-25" style="margin:auto;">
  <label for="eesnimi">Eesnimi: </label>
  <input class="form-control" id="eesnimi" type="text" value=<?php echo $_POST["eesnimi"]; ?>>
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="perenimi">Perenimi: </label>
  <input class="form-control" id="perenimi" type="text" value=<?php echo $_POST["perenimi"]; ?>>
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="kuupaev">Kuupäev: </label>
  <input class="form-control" id="kuupaev" type="date" value=<?php echo $_POST["kuupaev"]; ?>>
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="email">Email: </label>
  <input class="form-control" id="email" type="email" value=<?php echo $_POST["email"]; ?>>
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="email">Meili saaja: </label>
  <input class="form-control" id="emails" type="email" value=<?php echo $_POST["emails"]; ?>>
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="grupi_id">Grupi ID: </label>
  <input class="form-control" id="grupi_id" type="number" value=<?php echo $_POST["grupi_id"]; ?>>
  </div>
 <div class="form-group text-center my-2">
 <label class="form-check-label" for="aktiivne">Aktiivne</label>
 <input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne" <?php if($_POST['aktiivne'] == 'Jah') echo 'checked';?>>
  </div>
  <input value="Muuda" type="submit" class="btn btn-info mx-auto mb-3 d-block"> 
</form>