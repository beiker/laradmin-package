<form action="{{ URL::to('/') }}" method="GET" class="form-search">
  <fieldset>
    <legend>Filtros</legend>
    <div class="input-prepend input-append">
      <span class="add-on"><i class="icon-search"></i></span>
      <input type="text" name="filtro" class="input-large" id="filtro"
        value="" placeholder="Modificar, usuarios/agregar">
      <button class="btn">Buscar</button>
    </div>
  </fieldset>
</form>