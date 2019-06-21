<h1 class="display-3 text-center my-5 font-weight-bold" >Lisa inimene</h1>
<form action="/index.php" method="post">
  <div class="form-group w-25" style="margin:auto;">
  <label for="eesnimi">Eesnimi: </label>
  <input class="form-control" id="eesnimi" type="text" placeholder="Eesnimi">
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="perenimi">Perenimi: </label>
  <input class="form-control" id="perenimi" type="text" placeholder="Perenimi">
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="kuupaev">Kuupäev: </label>
  <input class="form-control" id="kuupaev" type="date" placeholder="DD/MM/YYYY">
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="email">Meili saaja: </label>
  <input class="form-control" id="email" type="email" placeholder="Email">
  </div>
  <div class="form-group w-25" style="margin:auto;">
  <label for="grupi_id">Grupi ID: </label>
  <input class="form-control" id="grupi_id" type="number" placeholder="ID">
  </div>
 <div class="form-group text-center my-2">
 <label class="form-check-label" for="aktiivne">Aktiivne</label>
 <input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne">
  </div>
  <input value="Lisa" type="submit" class="btn btn-primary lisa mx-auto mb-3 border-0 d-block"> 
</form>