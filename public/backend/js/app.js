$('.custom-file-input').on('change', function() { 
    let fileName = $(this).val().split('\\').pop(); 
    $(this).next('.custom-file-label').addClass("selected").html(fileName); 
 });

 $( "#rol" ).change(function() {
    value = this.value;

    if (value == 'directivo') {
        $("#cargo_uic_div").show();
    }
    else {
        $("#cargo_uic").val("");
        $("#cargo_uic_div").hide();
    }
  });

//   $( "#tipo" ).change(function() {
//     value = this.value;

//     if (value != '') {
//         $("#miembros_deleg").show();
//     }
//     else {
//         $("#cargo_uic").val("");
//         $("#miembros_deleg").hide();
//     }
//   });

  



