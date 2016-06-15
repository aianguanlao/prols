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

    
    });

    $('.btn-default').click(function(e){
        e.preventDefault();

        $('.list-group-item input').attr("readonly", false); 
        $('.edit-this').css({'display' : 'block'});
        $('.btn-success').css({'display' : 'inline'});
        $('.btn-warning').css({'display' : 'inline'});
        $('.btn-default').css({'display' : 'none'});


    });

      $('.btn-success').click(function(e){
        e.preventDefault();

        // if ($(this).parent('.list-group-item').find('input').val() == '') {
        //         $('.required').css({'display' : 'inline'})
        //     }
        //      else {
                $('.list-group-item input').attr("readonly", false); 
                $('.edit-this').css({'display' : 'none'});
                $('.btn-success').css({'display' : 'none'});
                $('.btn-warning').css({'display' : 'none'});
                $('.required').css({'display' : 'none'})
                $('.btn-default').css({'display' : 'block'});
            // }           
    });

       $('.btn-warning').click(function(e){
        e.preventDefault();

        $('.list-group-item input').attr("readonly", false); 
        $('.edit-this').css({'display' : 'none'});
        $('.btn-success').css({'display' : 'none'});
        $('.btn-warning').css({'display' : 'none'});
        $('.btn-default').css({'display' : 'block'});


    });

    $( ".edit-this" ).click(function(e) {

        e.preventDefault();
        $(this).parent('.list-group-item').find('input').val('').focus();


    });

   



    
    $('.btn-confirm-timeout').click(function(e){
        e.preventDefault();
        $('.alert-message-timeout').show();
        $('#mb-timeout').removeClass('open');
    });

    $('.btn-confirm-timein').click(function(e){
        e.preventDefault();
        $('.alert-message-timein').show();
        $('#mb-timein').removeClass('open');
    });
    $('.btn-confirm-accept').click(function(e){
        e.preventDefault();
        $('.alert-message-accept').show();
        $('#mb-accept').removeClass('open');
    });

    $('.btn-confirm-reject').click(function(e){
        e.preventDefault();
        $('.alert-message-reject').show();
        $('#mb-reject').removeClass('open');
    });
});   