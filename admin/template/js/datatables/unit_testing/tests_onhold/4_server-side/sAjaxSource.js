// DATA_TEMPLATE: empty_table
oTest.fnStart( "sAjaxSource" );

/* Sanitfy check really - all the other tests blast this */

$(document).ready( function () {
	/* Check the default */
	var oTable = $('#example').dataTable( {
		"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.html"
	} );
	var oSettings = oTable.fnSettings();
	
	oTest.fnWaitTest( 
		"Server side is off by default",
		null,
		function () { 
			return oSettings.sAjaxSource == "../../../examples/server_side/scripts/server_processing.html";
		}
	);
	
	oTest.fnComplete();
} );