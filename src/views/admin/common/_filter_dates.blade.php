<form action="{{ URL::to('/') }}" method="GET" class="form-search">
  <div class="form-actions form-filters">

    <div class="span6">
      <div class="row-fluid">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-calendar"></i></span>
          <input type="text" name="ffecha1" class="input-medium" id="ffecha1"
            value="" placeholder="2013-01-01">
        </div>

        <div class="input-prepend">
          <span class="add-on"><i class="icon-calendar"></i></span>
          <input type="text" name="ffecha2" class="input-medium" id="ffecha2"
            value="" placeholder="2013-01-31">
        </div>

        <button type="submit" class="btn">Buscar</button>
      </div>
    </div>

    <div class="span6">
      <!-- More Here -->
    </div>

  </div>
</form>