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
    $(document).on('click','.updateSectionStatus',function(){
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

  //brands active inactive
    $(document).on('click','.updateBrandstatus',function(){
      var status =$(this).children("i").attr("status");
      var brand_id =$(this).attr('brand_id');
      $.ajax({
            type:'post',
            url:'/admin/update-brand-status',
            data:{status:status,brand_id:brand_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#brand-'+brand_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>").css('color', 'red');
                }else if (resp['status']==1){
                    $('#brand-'+brand_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });

  //banners active inactive
    $(document).on('click','.updateBannerstatus',function(){
      var status =$(this).children("i").attr("status");
      var banner_id =$(this).attr('banner_id');
      $.ajax({
            type:'post',
            url:'/admin/update-banner-status',
            data:{status:status,banner_id:banner_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#banner-'+banner_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>").css('color', 'red');
                }else if (resp['status']==1){
                    $('#banner-'+banner_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });


  //Category active inactive
    $(document).on('click','.updateCategoryStatus',function(){
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



  //sweet alart js
    $(document).on('click','.confirmDelete',function(){ 
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
    $(document).on('click','.updateproductStatus',function(){
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


   //attribute active inactive
    $(document).on('click','.updateattributeStatus',function(){
      var status =$(this).text();
      var attribute_id =$(this).attr('attribute_id');
      $.ajax({
            type:'post',
            url:'/admin/update-attribute-status',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#attribute-'+attribute_id).html("Inactive").css('color', 'red');
                }else if (resp['status']==1){
                    $('#attribute-'+attribute_id).html("Active").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });


// product attributes 
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="size[]" placeholder="Size" required="" style="margin-top: 5px; margin-right:3px; width:90px;"/><input type="text" name="sku[]"  placeholder="SKU" required="" style="margin-top: 5px; margin-right:3px; width:90px;"/><input type="number" name="price[]"placeholder="Price" required=""  style="margin-top: 5px; margin-right:3px; width:90px;"/><input type="number" name="stock[]" placeholder="Stock" required=""  style="margin-top: 5px; margin-right:3px; width:90px;"/><a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm" style="margin-left: 5px !important;margin-top: -4px !important;"><i class="fas fa-trash"></i></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });





           //product image active inactive
    $(document).on('click','.updateImagestatus',function(){
      var status =$(this).text();
      var image_id =$(this).attr('image_id');
      $.ajax({
            type:'post',
            url:'/admin/update-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp) {
                if (resp['status']==0) {
                    $('#image-'+image_id).html("Inactive").css('color', 'red');
                }else if (resp['status']==1){
                    $('#image-'+image_id).html("Active").css('color', 'green');
                }
            },error:function(){
                alert('Error');
            }
      });
  });