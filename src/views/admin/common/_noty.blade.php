<!-- Bloque noty -->
@if((Session::has('noty') || $errors->any()) && ( ! Session::has('alertbs')))
  <?php
    $message = (Session::has('noty')) ?
      Session::get('noty')['message'] :
      implode('<br>', $errors->all(':message'));

    $ico = (Session::has('noty')) ?
      Session::get('noty')['ico'] :
      'error';
  ?>
  <script>
    $(function(){
      noty({
        "text":"{{ $message }}",
        "layout":"topRight",
        "type":"{{ $ico }}"});
    });
  </script>
@endif
<!-- Bloque noty -->