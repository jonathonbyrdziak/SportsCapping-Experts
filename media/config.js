
jQuery(document).ready(function(){

	//Setting the tabs
	if (readCookie('tablink') == null){
		createCookie('tablink', '#settings', 30);
	}
	toggletabs(readCookie('tablink')); //default tab goes here
	
	jQuery.each(jQuery('.tablink'), function(){
		jQuery(this).click(function(event){
			event.preventDefault(); 

			var href = jQuery(this).attr('href');

			toggletabs(href);
			
		});
	});
	
	//setting the support form functions
	jQuery('#postcommentbutton').click(function(evt){ 
		evt.preventDefault();
		var query = 'email='+ jQuery('#email').val()
				  + '&author='+ jQuery('#author').val()
				  + '&url='+ jQuery('#url').val()
				  + '&comment='+ jQuery('#comment').val()
				  + '&postingcomment=true'
				  + '&comment_post_ID='+jQuery('#supportid').attr('data')
				  + '&comment_parent=0'
				  + '&_wp_unfiltered_html_comment=8a1392377e';
				
		jQuery.ajax({
			type: "GET",
			url: "__HTTP__/config_support.php?"+query,
			dataType: "text",
			success: function(msg){
				jQuery('#commentsgohere').html(msg);
			},
			request: function(){
				alert('test');
			}
		});
		return false;
		
	});
	
});

function toggletabs(id){
	jQuery.each(jQuery('.tabdiv'), function(){
		jQuery(this).css('display', 'none');
	});
	
	jQuery.each(jQuery('.tablink'), function(){
		jQuery(this).removeClass('current');
	});
	
	jQuery.each(jQuery('[href='+ id +']'), function(){
		jQuery(this).addClass('current');
	});
	
	jQuery(id).css('display', 'block');
	
	createCookie('tablink', id, 30);
}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}
