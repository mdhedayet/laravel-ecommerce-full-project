 $("#current_pwd").keyup(function(){
  var current_pwd = $("#current_pwd").val();
  $.ajax({
   type:'post',
   url:'/admin/check-current-pwd',
   data:{current_pwd:current_pwd},
   success:function(resp){
        if (!$('#current_pwd').val()=="") {
            if(resp=="false"){
            $("#checkCurrentPassword").html("Current Password is incorrect").css('color', 'red');
            }else if(resp=="true"){
            $("#checkCurrentPassword").html("Current Password is correct").css('color', 'green');
            }
        }
   },error:function(){
    alert("Error");
   }
  });
 });

//check new password and confirm password is same are not.

 $('#new_pwd, #confirm_pwd').on('keyup', function () {
     if (!$('#confirm_pwd').val()=="") {
         if ($('#new_pwd').val() == $('#confirm_pwd').val()) {
            $('#message').html('New & confirm password is Match').css('color', 'green');
            }
        else{
            $('#message').html('New & confirm password not Match').css('color', 'red');
            }
     }
});


//upload file name show js
$('.custom-file input').change(function (e) {
    var files = [];
    for (var i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name);
    }
    $(this).next('.custom-file-label').html(files.join(', '));
});

//page script
$(function () {
    $("#example1").DataTable();
  });


  //section active inactive
  $('.updateSectionStatus').click(function(){
      var status =$(this).text();
      var section_id =$(this).attr('section_id');
      $.ajax({
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#section-'+section_id).html("Inactive").css('color', 'red');
                }else if (resp['status']==1){
                    $('#section-'+section_id).html("Active").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });
  //Category active inactive
  $('.updateCategoryStatus').click(function(){
      var status =$(this).text();
      var category_id =$(this).attr('category_id');
      $.ajax({
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#category-'+category_id).html("Inactive").css('color', 'red');
                }else if (resp['status']==1){
                    $('#category-'+category_id).html("Active").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });

//select item add category

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });


  //appen category level

  $('#section_id').change(function(){
      var section_id = $(this).val()
      $.ajax({
          type:'post',
          url:'/admin/appen-category-level',
          data:{section_id:section_id},
          success:function(resp){
            $('#appenCategoryLavel').html(resp);
          },error:function(){
                alert('Error');
            }
      });
  });


  // confirm delete
  /* $('.confirmDelete').click(function(){
    var name=$(this).attr("name");
    if (confirm("Are you sure delete this" +name+ "?")) {
        return true;
    }
    return false;
  }); */


  //sweet alart js
  $('.confirmDelete').click(function(){
    var name=$(this).attr("name");
    var nameid=$(this).attr("nameid");
    Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure delete this" +name+ "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href="/admin/delete-"+name+"/"+nameid;
        }
        })
    return false;
  });


   //product active inactive
  $('.updateproductStatus').click(function(){
      var status =$(this).text();
      var product_id =$(this).attr('product_id');
      $.ajax({
            type:'post',
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#product-'+product_id).html("Inactive").css('color', 'red');
                }else if (resp['status']==1){
                    $('#product-'+product_id).html("Active").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });