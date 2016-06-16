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


    

    // setTimeout(function(){
    //     $('.alert-message-timeout').addClass('');
    // }, 5000);




    $('.btn-edit-profile').click(function(e){
        e.preventDefault();

        $('.list-group-item input').attr("readonly", false); 
        $('.edit-this').css({'display' : 'block'});
        $('.btn-save-profile').css({'display' : 'inline'});
        $('.btn-cancel-profile').css({'display' : 'inline'});
        $('.btn-edit-profile').css({'display' : 'none'});



    });

      // $('.btn-success').click(function(e){
      //   // e.preventDefault();
      //   $validate = false;

      //   if ($("#telP").val() != '') && ($("#cellP").val() != '') && ($("#address").val() != '')){
      //       validate = true;
      //       $('.edit-this'.css({'display': 'none'}))
      //       $('.btn-success').css({'display' : 'none'});
      //       $('.btn-warning').css({'display' : 'none'});
      //       $('.btn-default').css({'display' : 'block'});
      //       $('.required').css({'display' : 'none'})
      //   }

      //   else{}

        // if ($(this).parent('.list-group-item').find('input').val() == '') {
        //         $('.required').css({'display' : 'inline'})
        //     }
        //      else {
        //         $('.list-group-item input').attr("readonly", false); 
        //         $('.edit-this').css({'display' : 'none'});
        //         $('.btn-success').css({'display' : 'none'});
        //         $('.btn-warning').css({'display' : 'none'});
        //         $('.required').css({'display' : 'none'})
        //         $('.btn-default').css({'display' : 'block'});
        //     }           
    // });

    //    $('.btn-success').click(function(e){
    //     e.preventDefault();


    //    if (($("#telP").val() == '') || ($("#cellP").val() == '') || ($("#address").val() == '')){
    //             $('.required').css({'display' : 'inline'})
    //         }
    //          else {
    //             $('.list-group-item input').attr("readonly", false); 
    //             $('.edit-this').css({'display' : 'none'});
    //             $('.btn-success').css({'display' : 'none'});
    //             $('.btn-warning').css({'display' : 'none'});
    //             $('.required').css({'display' : 'none'})
    //             $('.btn-default').css({'display' : 'block'});
    //         }           
    // });


    // $('.btn-success').click(function(e)){
        


    // });

$('.btn-save-profile').click(function(e){
        e.preventDefault();
        $validate = false;

        $('.btn-edit-profile').css({'display' : 'none'});

        if( !$("#cellP").val() == '') {
            $validate = true;
            $("#cellP").closest('.list-group-item').find('.edit-this').css({'display' : 'block'});
            $("#cellP").closest('.list-group-item').find('.required').css({'display' : 'none'})
        } else {
            $("#cellP").closest('.list-group-item').find('.required').css({'display' : 'inline'})
        }

        if( !$("#telP").val() == '') {
            $validate = true;
            $("#telP").closest('.list-group-item').find('.edit-this').css({'display' : 'block'});
            $("#telP").closest('.list-group-item').find('.required').css({'display' : 'none'})
        } else {
            $("#telP").closest('.list-group-item').find('.required').css({'display' : 'inline'})
        }

        if( !$("#address").val() == '') {
            $validate = true;
            $("#address").closest('.list-group-item').find('.edit-this').css({'display' : 'block'});
            $("#address").closest('.list-group-item').find('.required').css({'display' : 'none'})
        } else {
            $("#address").closest('.list-group-item').find('.required').css({'display' : 'inline'})
        }


        if(!$("#cellP").val() == '' && $validate == true && !$("#telP").val() == '' && !$("#address").val() == '') {
            $('.btn-save-profile').css({'display' : 'none'});
            $('.btn-cancel-profile').css({'display' : 'none'});
            $('.edit-this').css({'display' : 'none'});
            $('.btn-edit-profile').css({'display' : 'block'});
        } else {
            e.preventDefault();
        }

            // if (($("#telP").val() != '') && ($("#cellP").val() != '') && ($("#address").val() != '')){

            //         $validate = true;
            //         $('.edit-this').css({'display': 'none'});
            //         $('.required').css({'display' : 'none'})
            //     }

            // else if(($("#telP").val() == '') && ($("#cellP").val() == '') && ($("#address").val() == '')){
            //     $validate = true; 

            //     $('.edit-this').css({'display': 'display'});
            //     $('.btn-default').css({'display' : 'none'});
            //     $('#tel .required').css({'display' : 'inline'})
            //     $('#cel .required').css({'display' : 'inline'})
            //     $('#addr .required').css({'display' : 'inline'})
            //     $('.list-group-item input').attr("readonly", false); 

            // }
           

            // else if (($("#telP").val() == '')){
            //     $validate = true;

            //     $('.list-group-item input').attr("readonly", false); 
            //     $('.edit-this').css({'display' : 'block'});
            //     $('#tel .required').css({'display' : 'inline'})
            //     $('.btn-default').css({'display' : 'none'});
            //     $("#telP").closest('.list-group-item').find('.edit-this').css({'display' : 'block'});

            // }           

            // else if($("#cellP").val() == ''){
            //     $validate = true;

            //     $('.list-group-item input').attr("readonly", false); 
            //     $('.edit-this').css({'display' : 'block'});
            //     $('.btn-success').css({'display' : 'inline'});
            //     $('.btn-warning').css({'display' : 'inline'});
            //     $('#cel .required').css({'display' : 'inline'})
            //     $("#cellP").closest('.list-group-item').find('.edit-this').css({'display' : 'block'});
                
            // }  

            //  else if($("#address").val() == ''){
            //     $validate = true;

            //     $('.list-group-item input').attr("readonly", false); 
            //     $('#addr .required').css({'display' : 'inline'})
            //     $('.btn-default').css({'display' : 'none'});
            //     $("#address").closest('.list-group-item').find('.edit-this').css({'display' : 'block'});
            // }         

            // else if ($validate == true) {

            //         $('.btn-success').css({'display' : 'none'});
            //         $('.btn-warning').css({'display' : 'none'});
            //         $('.btn-default').css({'display' : 'block'});
            //  }

            // else{
            //     $validation = false;
            //     e.preventDefault();

            // }           

        
         

    });





       $('.btn-cancel-profile').click(function(e){
        e.preventDefault();

        $('.list-group-item input').attr("readonly", false); 
        $('.edit-this').css({'display' : 'none'});
        $('.btn-save-profile').css({'display' : 'none'});
        $('.btn-cancel-profile').css({'display' : 'none'});
        $('.btn-edit-profile').css({'display' : 'block'});
        $('.required').css({'display' : 'none'});


    });

    $( ".edit-this" ).click(function(e) {

        e.preventDefault();
        $(this).parent('.list-group-item').find('input').val('').focus();


    });

    $('.btn-addevent').click(function(e){
        e.preventDefault();
        

        if ($("#event").val() == '') {
                $('.required').css({'display' : 'inline'})
            }
             else {
               
                $('.success-addevent').css({'display' : 'block'})
                $('#event').val('');
            }           
    });


    $('#close-alert2').click(function(){
        $('#close-alert2').addClass('anim');

    });

    $('#close-alert1').click(function(){
        $('#close-alert1').addClass('anim');

    });

    
    $('.btn-confirm-timeout').click(function(e){
        e.preventDefault();
        $('.alert-message-timeout').show();
        $('#mb-timeout').removeClass('open');

         setTimeout(function(){
            $('.alert-message-timeout').addClass('anim');
        }, 5000);
    });

    $('.btn-confirm-timein').click(function(e){
        e.preventDefault();
        $('.alert-message-timein').show();
        $('#mb-timein').removeClass('open');

        setTimeout(function(){
            $('.alert-message-timein').addClass('anim');
        }, 5000);
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