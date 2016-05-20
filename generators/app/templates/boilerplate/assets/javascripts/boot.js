jQuery(function($) {
	//set route in application
	MONKEY.dispatcher( MONKEY.<%= titleCamel %>, window.pagenow, [$( 'body' )] );
});