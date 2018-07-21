$('.form').find('input, textarea').on('keyup blur focus', function (e) {

  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }
});

$(document).ready(function () {
    if(document.getElementById("form-login-nick").value != ''){
        document.getElementById("label-login-nick").className = 'active';
    }
    if(document.getElementById("form-login-password").value !=''){
        document.getElementById("label-login-password").className = 'active';
    }
    if(document.getElementById("form-register-nick").value !=''){
        document.getElementById("label-register-nick").className = 'active';
    }
    if(document.getElementById("inputPassword").value !=''){
        document.getElementById("label-register-password").className = 'active';
    }
});


$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});