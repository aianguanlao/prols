$(document).ready(function(){        
 
    $('.btn-time').on('click', function(e){
        e.preventDefault();
        
        if($(this).hasClass('time-out')) {
        	$('#mb-timeout').addClass('open');
        } else {
            $('#mb-timein').addClass('open');
        }
    });   

    $('.btn-confirm-timein').click(function(e){
    	e.preventDefault();

    	$('#mb-timein').removeClass('open');
    	$('.btn-time').addClass('time-out').find('.xn-text').html('Time Out');

    	// if($('.btn-time').hasClass('time-out')) {
     //        $('.btn-time').removeClass('time-out').find('.xn-text').html('Time In');
     //    } else {
            

     //    }
    });
});   