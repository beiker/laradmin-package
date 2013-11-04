var msb = {
	confirm: function(msg, title, obj, callback){
		$("body").append('<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
      ' <div class="modal-dialog">'+
      '   <div class="modal-content">'+
		  '     <div class="modal-header">'+
			'      <button type="button" class="close" data-dismiss="modal">×</button>'+
			'	     <h3>'+title+'</h3>'+
			'    </div>'+
			'    <div class="modal-body">'+
			'      <p>'+msg+'</p>'+
			'    </div>'+
			'    <div class="modal-footer">'+
			'      <a href="#" class="btn" data-dismiss="modal">No</a>'+
			'      <a href="#" class="btn btn-primary">Si</a>'+
			'    </div>'+
      '   </div><!-- /.modal-content -->'+
      ' </div><!-- /.modal-dialog -->'+
			'</div><!-- /.modal -->'
    );

		$('#myModal').modal().on('hidden.bs.modal', function () {
      $(this).remove();
    })

		$('#myModal .btn-primary').on('click', function(){
			if($.isFunction(callback)) {
				callback.call(this, obj);
      } else {
				window.location = obj.href;
      }

			$('#myModal').modal("hide");
		});
		return false;
	}
};