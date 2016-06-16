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
    $('.btn-confirm-timeout').click(function(e){
        e.preventDefault();

        $('#mb-timeout').removeClass('open');
        $('.btn-time').removeClass('time-out').find('.xn-text').html('Time In');

});

    $(document).ready(function(){        

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
});   