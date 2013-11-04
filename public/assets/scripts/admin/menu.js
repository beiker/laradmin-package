$(function(){
	panel.init();
});

var panel = (function($) {
	var objr = {};

	function activeMenu() {
		//highlight current / active link
		$('ul.menu-options li a').each(function(){
			//var url = String(window.location).split("?");
			var url  = String(window.location).replace(base_url, ''), url1 = url.split('/'), url2 = url.split("?"),
    			link = $($(this))[0].href.replace(base_url, ''), link1 = link.split('/');

      // if(link==url || (link1[0]==url1[0] && link1[1]==url1[1]) || link==url2[0])
			if(link==url)
				$(this).parents('li').addClass('active');
		});
		// $('ul.main-menu > li.active > a').click();

		var mmdat = $("#menu_dat");
		mmdat.on('click', function(){
			var vthis = $(this);
			if (mycookies.getCookie("menu_collapsi") == null || mycookies.getCookie("menu_collapsi") == 'no') {
				mycookies.setCookie("menu_collapsi", 'si', 1);
			}else{
				mycookies.setCookie("menu_collapsi", 'no', 1);
			}
			tipoMenu(vthis);

			return false;
		});
		tipoMenu(mmdat);
	};

	function tipoMenu(vthis) {
		if (mycookies.getCookie("menu_collapsi") == null || mycookies.getCookie("menu_collapsi") == 'no') {
			$("#main_menu").removeClass("chiqui");
			$("#content.span10").removeClass("big");
			$('i', vthis).removeClass("icon-arrow-right").addClass("icon-arrow-left");
		}else{
			$("#main_menu").addClass("chiqui");
			$("#content.span10").addClass("big");
			$('i', vthis).removeClass("icon-arrow-left").addClass("icon-arrow-right");
		}
	}

	function animeMenu() {
    $('ul.menu-options li[data-parent="true"]:not(.active)').hover(function() {
      // $(this).animate({'margin-left':'+=5'},300);
      $(this).addClass('active');
    },
    function(){
      // $(this).animate({'margin-left':'-=5'},300);
      $(this).removeClass('active');
    });
	};

	function boxBtns() {
		$('.btn-close').click(function(e){
			e.preventDefault();
			$(this).parent().parent().parent().fadeOut();
		});
		$('.btn-minimize').click(function(e){
			e.preventDefault();
			var $target = $(this).parent().parent().next('.box-content');
			if($target.is(':visible')) $('i',$(this)).removeClass('icon-chevron-up').addClass('icon-chevron-down');
			else 					   $('i',$(this)).removeClass('icon-chevron-down').addClass('icon-chevron-up');
			$target.slideToggle();
		});
	};

	objr.menu = function(id){
		var obj = $("#subm"+id);
		if (obj.is(".hide"))
			obj.attr('class', 'show');
		else
			obj.attr('class', 'hide');
	};

	objr.init = function(){
		activeMenu();
		animeMenu();
		// boxBtns();
	};

	return objr;
})(jQuery);

var mycookies = (function(){
  var objr = {};
  function setCookie(c_name,value,exdays)
  {
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value + "; path=/";
  }

  function getCookie(c_name)
  {
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1){
      c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1){
      c_value = null;
    }else{
      c_start = c_value.indexOf("=", c_start) + 1;
      var c_end = c_value.indexOf(";", c_start);
      if (c_end == -1){
        c_end = c_value.length;
      }
      c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
  }

  objr.setCookie = setCookie;
  objr.getCookie = getCookie;
  return objr;
})();