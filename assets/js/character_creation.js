
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    /*$.backstretch([
                    "assets/img/backgrounds/6.jpg"
	              , "assets/img/backgrounds/7.jpg"
	              , "assets/img/backgrounds/8.jpg"
                  , "assets/img/backgrounds/9.jpg"
	             ], {duration: 6000, fade: 750});
    */
    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
