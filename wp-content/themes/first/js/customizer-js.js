( function( $ ) {

	// Add upgrade link
	upgrade = $( '<a class="themehaus-link"></a>' )
			.attr( 'href', first_customizer_links.url )
			.attr( 'target', '_blank' )
			.text( first_customizer_links.label );
	$( '.preview-notice' ).append( upgrade );

} )( jQuery );