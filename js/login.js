(function($){
    "use strict";
    $(document).ready(function() {
       $('#loginform label, #registerform label').each(function() {
           $('input', this).attr('placeholder', $(this).text());
       });
       
       $('.login').prepend('<div class="login-header"><div class="home">' + $('#backtoblog').html() + '</div></div>');
       
       if ($('.login form').is('#loginform')) {
           $('.login-header').append('<h1>Log in</h1>');
       } 
       if ($('.login form').is('#registerform')) {
           $('.login-header').append('<h1>Register</h1>');
       }
       
       $('.login-header').append('<nav class="login-sub-menu"></nav>');
       
       if ($('.login #nav').length === 1) {
           
       } else {
            if ($('.login form').is('#lostpasswordform')) {
                var link_reg = $('#login #nav a:last-child');
                $('.login-sub-menu').append('<a href="' + link_reg.attr('href') + '">' + link_reg.text() + '</a>&nbsp;&nbsp;&nbsp;&nbsp;');
            }
       }
       
       var link = $('#login #nav a:first-child');
       
       $('.login-sub-menu').append('<a href="' + link.attr('href') + '">' + link.text() + '</a>');
       
       $('.login .forgetmenot label').prepend('<div class="checkbox"></div>');
       
       $('.login .forgetmenot label').click(function() {
           if ($('input', this).prop("checked")) {
               $('.checkbox', this).addClass('checked');
           } else {
               $('.checkbox', this).removeClass('checked');
           }
       });
    });
})(jQuery);