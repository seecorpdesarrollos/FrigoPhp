$(document).ready(function() {
	// $('#ventas').on('click',  function() {
	   // $('#ventas').addClass('active');
	    var pathname = window.location.pathname;
	    var ruta = pathname.split('/');
	    console.log(ruta[2]);
	    if (ruta[2] == "ventas") {
	    	 $('#ventas').addClass('active');
	    	} else if( ruta[2] == "reportesVentas"){
	    		 $('#reportesVentas').addClass('active');
	    	}
	// });
});