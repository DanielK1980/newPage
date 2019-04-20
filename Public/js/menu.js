( function( $ ) {
$( document ).ready(function() {
$('#cssmenu').prepend('<div id="menu-button" style="width:100%"><img src="/Public/img/logoCBB2.png" height="60" width="102" alt=""><span style="padding: 12px;color:white;font-size:33px;text-align:right;display:block;float:right;" class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
});
} )( jQuery );
