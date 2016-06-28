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
});   

  //  $('.modal-trigger').leanModal({
  //     dismissible: true, // Modal can be dismissed by clicking outside of the modal
  //     opacity: .5, // Opacity of modal background
  //     in_duration: 300, // Transition in duration
  //     out_duration: 200, // Transition out duration
  //     ready: function() { alert('Ready'); }, // Callback for Modal open
  //     complete: function() { alert('Closed'); } // Callback for Modal close
  //   }
  // );  