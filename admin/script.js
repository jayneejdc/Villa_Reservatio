$(document).ready(function(){
  $('#ui-datepicker-div').css('clip', 'auto');
  $('.alert-success').hide();
  $('.alert-danger').hide();
  function notification(num){
    if(num == -1){
      $('.alert-danger').show();
      $('.alert-danger').delay(2000).slideUp();
      return false;
    }else{
      $('.alert-success').show();
      $('.alert-success').delay(2000).slideUp();
      location.reload();
    }
  }
  var a = 0;//denotes room rate
  var b = 0;//denotes additional services fee
  var c = 0;//denotes number of days;
  var d = 0;//final
  var fee = 0;
  //js for reservation
  function displayTotalRes(a,b,c){
      $('#fee_final').text((c*a)+(c*b));
      $('#stay').text(c);
  }
  function admin_reservation_display(){
    $.ajax({
      url: "includes/admin_reservation_display.php",
      type: "POST",
      success: function (data) {
        console.log(data);
        $('#display_booking').html(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
         console.log(textStatus, errorThrown);
      }  
    })
  }
  function show_user_reserve_bookings(){
    $.ajax({
      url: "includes/show_user_reserve_bookings.php",
      type: "POST",
      success: function (data) {
        console.log(data);
        $ ('#reserve_book').html(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
         console.log(textStatus, errorThrown);
      }  
    })
  }
  $( '#user_reserve' ).on('click',function(){
    show_user_reserve_bookings();
  });
  function updateReservation(status){
    var x = status;
    console.log(status);
    if(x == 1){
      $.ajax({
          url: "includes/updateReservation.php",
          type: "POST",
          data: { 
              status : "Confirmed",
              id :  $('#reservation_admin_field').prop('value')
          } ,
          success: function (data) {
              if(data!=-1){
                location.reload();
              }else{
                 notification(data);
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }  
      })
    }else if(x==2){
      $.ajax({
          url: "includes/updateReservation.php",
          type: "POST",
          data: { 
              status : "Restored",
              id :  $('#reservation_admin_field').prop('value')
          } ,
          success: function (data) {
              if(data!=-1){
                location.reload();
              }else{
                notification(data);
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }  
      })
    }else{
        $.ajax({
          url: "includes/updateReservation.php",
          type: "POST",
          data: { 
              status : "Archived",
              id :  $('#reservation_admin_field').prop('value')
          } ,
          success: function (data) {
            console.log(data)
            if(data!=-1){
                location.reload();
            }else{
                notification(data);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }  
        })
      }
    }
  function updateBooking(status){
    var x = status;
    console.log(status);
    if(x == 1){
      $.ajax({
        url: "includes/updateBooking.php",
        type: "POST",
        data: { 
            status : "Confirmed",
            id :  $('#booking_admin_field').prop('value')
         } ,
        success: function (data) {
          if(data!=-1){
            location.reload();
          }else{
             notification(data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }  
      })
    }else if(x==2){
      $.ajax({
        url: "includes/updateBooking.php",
        type: "POST",
        data: { 
            status : "Restored",
            id :  $('#booking_admin_field').prop('value')
         } ,
        success: function (data) {
          if(data!=-1){
            location.reload();
          }else{
             notification(data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }  
      })
    }else{
      $.ajax({
        url: "includes/updateBooking.php",
        type: "POST",
        data: { 
            status : "Archived",
            id :  $('#booking_admin_field').prop('value')
         } ,
        success: function (data) {
          console.log(data)
          if(data!=-1){
            location.reload();
          }else{
             notification(data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }  
      })
    }
  }
  $('#select-type1').change(function(){
     var data = $(this).val();
     $.post('includes/getRoomType.php', {
        room_type: data 
     },function(data){
        var room_data = JSON.parse(data);
        console.log(room_data);
        $('#room_data').text(room_data.description);
        $('#room_cap').text(room_data.capacity);
        a = JSON.parse(room_data.room_rate);
        $('#room_rate').text(a);
        console.log(a);
        displayTotalRes(a,b,c);
     });
  });
  $('#select-type2').change(function(){
    var data = $(this).val();
    $.post('includes/getAccommodation.php', {
       additional_services: data 
    },function(data){
       var accom_data = JSON.parse(data);
       $('#accom_data').text(accom_data.description);
        add_fee=accom_data.fee;
        b = JSON.parse(accom_data.fee);
        $('#additional_fee').text(b);
        console.log(b);
        displayTotalRes(a,b,c);
    });
  });
  $('#datepicker-8').datepicker({
   dateFormat: 'yy-m-dd',
       inline: true,
       yearRange: "2017:2019",
       minDate: 0,
      maxDate: '+1Y+6M',
       onSelect: function(){
         var fullDate = $.datepicker.formatDate('M-dd-yy',$(this).datepicker('getDate'));
         console.log(fullDate);
         $('#check_in').text(fullDate);
         var min = $(this).datepicker('getDate'); // Get selected date
          $("#datepicker-9").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
        }
  });
  $('#datepicker-9').datepicker({
    dateFormat: 'yy-m-dd',
    inline: true,
    yearRange: "2017:2019",
    minDate: '0',
       maxDate: '+1Y+6M',
    onSelect: function(){
        var fullDate = $.datepicker.formatDate('M-dd-yy',$(this).datepicker('getDate'));
        console.log(fullDate);
        $('#check_out').text(fullDate);
        var max = $(this).datepicker('getDate'); // Get selected date
         $('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Set other max, default to +18 months
         var start = $("#datepicker-8").datepicker("getDate");
         var end = $("#datepicker-9").datepicker("getDate");
         var days = (end - start) / (1000 * 60 * 60 * 24);
         c = days+1;
         if($('#select-type3').prop('value') !="" || $('#select-type2').prop('value') != "1", $('#datepicker-8').prop('value') !="" || $('#datepicker-9').prop('value') !="" ){
           // $("#TextBox3").val(c+'-'+d);
             displayTotalRes(a,b,c);
         }
    }
  });
  function displayTotal(a,b,c){
      $('#fee_final_booking').text((c*a)+(c*b));
      $('#stay_booking').text(c);
  }
  //js for booking
  $('#select-type3').change(function(){
     var data = $(this).val();
     $.post('includes/getRoomType.php', {
        room_type: data 
     },function(data){
        var room_data = JSON.parse(data);
        console.log(room_data);
        $('#room_data_booking').text(room_data.description);
        $('#room_cap_booking').text(room_data.capacity);
        a = JSON.parse(room_data.room_rate);
         $('#room_rate_booking').text(a);
        console.log(a);
        displayTotal(a,b,c);
     });
  });
  $('#select-type4').change(function(){
    var data = $(this).val();
    $.post('includes/getAccommodation.php', {
       additional_services: data 
    },function(data){
       var accom_data = JSON.parse(data);
       $('#accom_data_booking').text(accom_data.description);
        add_fee=accom_data.fee;
        b = JSON.parse(accom_data.fee);
        $('#add_fee_booking').text(b);
        console.log(b);
        displayTotal(a,b,c);
    });
  });
  $('#datepicker-10').datepicker({
     dateFormat: 'yy-m-dd',
     inline: true,
     yearRange: "2017:2019",
     minDate: 0,
    maxDate: '+1Y+6M',
     onSelect: function(){
         var fullDate = $.datepicker.formatDate('M-dd-yy',$(this).datepicker('getDate'));
         console.log(fullDate);
         $('#check_in_booking').text(fullDate);
         var min = $(this).datepicker('getDate'); // Get selected date
          $("#datepicker-11").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
        }
   });
   $('#datepicker-11').datepicker({
     dateFormat: 'yy-m-dd',
     inline: true,
     yearRange: "2017:2019",
     minDate: '0',
        maxDate: '+1Y+6M',
     onSelect: function(){
        var fullDate = $.datepicker.formatDate('M-dd-yy',$(this).datepicker('getDate'));
        console.log(fullDate);
        $('#check_out_booking').text(fullDate);
        var max = $(this).datepicker('getDate'); // Get selected date
        $('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Set other max, default to +18 months
        var start = $("#datepicker-10").datepicker("getDate");
        var end = $("#datepicker-11").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
        c = days+1;
        if($('#select-type4').prop('value') !="" || $('#select-type3').prop('value') != "1", $('#datepicker-10').prop('value') !="" || $('#datepicker-11').prop('value') !="" ){
            // $("#TextBox3").val(c+'-'+d);
            displayTotal(a,b,c);
        }
     }
   });
    $('#payment').modal('hide');
    $('#book').click(function(){
        if($('#select-type3').prop('value')=="1" || $('#datepicker-10').prop('value')=="" || $('#datepicker-11').prop('value')==""){
          notification(-1);
      }else{
          $('#booking').modal('hide');
          $('#payment').modal('show');
      }
    });
    $('#pay_button').click(function(){
      var cnum = $('#cnum1').prop('value');
      console.log(cnum);
        $.ajax({
         url: "includes/booking.php",
         type: "POST",
         data: { 
           add : $('#select-type4').prop('value'),
           room_type : $('#select-type3').prop('value'),
           fee : $('#fee_final_booking').text(),
           state : "Pending confirmation",
           payment_scheme : $('#select-type5').prop('value'),
           date_in : $('#datepicker-10').prop('value'),
           date_out : $('#datepicker-11').prop('value'),
           //payment
           card_num : $('#cnum1').prop('value'),
           card_name: $('#cname').prop('value'),
           ccv : $('#ccv').prop('value'),
           book_date : $('#book_date').prop('value')
         } ,
         success: function (data) {
           console.log(data);
           if(data==-1 || data==-2){
              notification(-1);
           }else{
              notification(1);
           }
         },
         error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
         }
      });
    });
    $( '#reserve' ).click( function(){
      $.ajax({
           url: "includes/reservation.php",
           type: "POST",
           data: { 
               add :  $('#select-type2').prop('value'),
               room_type :  $('#select-type1').prop('value'),
               fee :  $('#fee_final').text(),
               state : "Pending confirmation",
               date_in : $('#datepicker-8').prop('value'),
               date_out : $('#datepicker-9').prop('value')
            } ,
           success: function (data) {
             console.log(data);
             if(data == -1){
                notification(-1);
             }else{
               window.location= "guest.php";
             }

           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
        });
    });
    $( '#confirm_reservation' ).click(function(){
      if(confirm('Would you like to continue?')==true){
        updateReservation(1);
      }
    });
    $( '#restore_reservation' ).click(function(){
      if(confirm('Would you like to continue?')==true){
        updateReservation(2);
      }
    });
    $( '#archive_reservation' ).click(function(){
      if(confirm('Would you like to continue?')==true){
        updateReservation(3);
      }
    });
    $( '#confirm_booking' ).click(function(){
      if(confirm('Would you like to continue?')==true){
        updateBooking(1);
      }
    });
    $( '#restore_booking' ).click(function(){
      if(confirm('Would you like to continue?')==true){
        updateBooking(2);
      }
    });
    $( '#archive_booking' ).click(function(){
      if(confirm('Would you like to continue?')==true){
        updateBooking(3);
      }

    });
    $ ( '#login_button' ).click(function(){
      $.ajax({
           url: "includes/login.inc.php",
           type: "POST",
           data: { 
               username :  $('#username').prop('value'),
               passw :  $('#pass').prop('value')
            } ,
           success: function (data) {
             console.log(data);
             if(data == 2){
              window.location = "admin.php";
             }else if(data == 1){
              window.location = "index2.php";
              console.log(data);
             }else{
              console.log(data);
              notification(data);
             }
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
        });
    });
    $ ( '#signup_button' ).click(function(){
      $.ajax({
           url: "includes/signup.inc.php",
           type: "POST",
           data: { 
               lname :  $('#lname').prop('value'),
               fname :  $('#fname').prop('value'),
               num :  $('#num').prop('value'),
               uname :  $('#uname').prop('value'),
               em :  $('#em').prop('value'),
               p1 :  $('#p1').prop('value'),
               p2 :  $('#p2').prop('value')
            } ,
           success: function (data) {
             console.log(data);
             if(data==-1){
              notification(-1)
             }else{
              console.log(data);
              window.location = "index.php";
             }
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
        });
    });
    $(document).on("click", ".cancel", function(event) {
            if(confirm('Do you want to cancel your reservation?')==true){
                $.ajax({
                 url: "includes/cancel.php",
                 type: "POST",
                 data: { 
                     id :  $('.cancel').prop('value')
                  } ,
                 success: function (data) {
                   console.log(data);
                   location.reload();
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                 }
              }); 
            }
             
    });
});

