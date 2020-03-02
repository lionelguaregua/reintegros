<script type="text/javascript">
	$('#btnReport').on('click', function(){

         reporte();

    });

</script>

<script>

function reporte() {
		var dataChart = new Array();
	    var _cliente =$('#cliente').val();
        var _cobertura =$('#cobertura').val(); 
        

$.ajaxSetup({
  headers: {
  	'X-CSRF-TOKEN': $('input[name = "_token"]').val(),
  }
});

	$.ajax({
  url: "{{url('/reportes/data')}}",
  method: "POST",
  data: { cliente : _cliente,
          cobertura : _cobertura },

})
	.done(function(msg){
     console.log(msg);
    })

}

</script>