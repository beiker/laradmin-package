(function (closure) {
  closure($, window);
})(function ($, window) {

  $(function () {

    showPasswordCheckbox();

    initTooltip();
    initUniform();
  });

  var initTooltip = function function_name () {
    $('[data-toggle="tooltip"]').tooltip({
      'container': 'body'
    });
  };

  var initUniform = function () {
    $('.uniform').uniform();
  };

  var showPasswordCheckbox = function () {
    $('#showPassword').on('click', function(event) {
      var $this = $(this),
          $pass = $('#password');
      if ($this.is(':checked')) {
        $pass.attr('type', 'text');
      } else {
        $pass.attr('type', 'password');
      }
    });
  };

});

/**
 * Obj para crear un loader cuando se use Ajax
 */
var loader = {
	create: function(wrapper){
		var css = 'style="position: fixed;left:40%; top:0px;background-color:#F9EDBE;padding:5px 10px; z-index:600;-webkit-border-bottom-right-radius: 5px;-webkit-border-bottom-left-radius: 5px;-moz-border-radius-bottomright: 5px;-moz-border-radius-bottomleft: 5px;border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;"',
		html = '<div id="ajax-loader" {css}> <img src="'+base_url+'application/images/bootstrap/ajax-loaders/ajax-loader-9.gif" width="24" height="24"> Cargando...</div>';

		if (wrapper){
			$(wrapper).append(html.replace("{css}", ""));
		}else{
			$("body").append(html.replace("{css}", css));
		}
	},
	close: function(){
		$("#ajax-loader").remove();
	}
};