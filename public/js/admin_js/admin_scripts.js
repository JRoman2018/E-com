 $(document).ready(function () {
    //Check Admin Password is correct or no
     $('#current_pwd').keyup(function () {
        var current_pwd = $('#current_pwd').val();
        // alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success:function (resp) {
                if (resp=="false"){
                    $('#chkCurrentPwd').html("<font color=red>Current Password is Incorrect</font>");
                }else if(resp=="true"){
                    $('#chkCurrentPwd').html("<font color=green>Current Password is Correct</font>");

                }
            },error:function () {
                alert("Error");
            }
        });
     });

     //DataTables
     $(function () {
         $("#sections").DataTable({
             "responsive": true,
             "autoWidth": false,
         });
         $("#categories").DataTable({
             "responsive": true,
             "autoWidth": false,
         });
         $("#products").DataTable({
             "responsive": true,
             "autoWidth": false,
         });
     });

    //Update Section Status
     $(".updateSectionStatus").click(function () {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            type:'post',
            url: '/admin/update-section-status',
            data: {status:status,section_id:section_id},
            success:function (resp) {
                if(resp['status']==0){
                    $("#section-"+section_id).html("<a class='updateSectionStatus text-danger' href='javascript:void(0)'>Inactive</a>");
                }else if(resp['status']==1){
                    $("#section-"+section_id).html("<a class='updateSectionStatus text-success' href='javascript:void(0)'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
     });

    //Update Category Status
     $(".updateCategoryStatus").click(function () {
         var status = $(this).text();
         var category_id = $(this).attr("category_id");
         $.ajax({
             type:'post',
             url: '/admin/update-category-status',
             data: {status:status,category_id:category_id},
             success:function (resp) {
                 if(resp['status']==0){
                     $("#category-"+category_id).html("<a class='updateCategoryStatus text-danger' href='javascript:void(0)'>Inactive</a>");
                 }else if(resp['status']==1){
                     $("#category-"+category_id).html("<a class='updateCategoryStatus text-success' href='javascript:void(0)'>Active</a>");
                 }
             },error:function(){
                 alert("Error");
             }
         });
     });

     //Update Product Status
     $(".updateProductStatus").click(function () {
         var status = $(this).text();
         var product_id = $(this).attr("product_id");
         $.ajax({
             type:'post',
             url: '/admin/update-product-status',
             data: {status:status,product_id:product_id},
             success:function (resp) {
                 if(resp['status']==0){
                     $("#product-"+product_id).html("<a class='updateProductStatus text-danger' href='javascript:void(0)'>Inactive</a>");
                 }else if(resp['status']==1){
                     $("#product-"+product_id).html("<a class='updateProductStatus text-success' href='javascript:void(0)'>Active</a>");
                 }
             },error:function(){
                 alert("Error");
             }
         });
     });

     //Append Category Level
     $('#section_id').change(function () {
        var section_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id:section_id},
            success:function (resp) {
                $("#appendCategoriesLevel").html(resp);
            },error:function () {
                alert("Error");
            }
        });
     });

     //Products Attribute Add/Remove Script
     var maxField = 10; //Input fields increment limitation
     var addButton = $('.add_button'); //Add button selector
     var wrapper = $('.field_wrapper'); //Input field wrapper
     var fieldHTML = '<div class="py-1"><input type="text" name="size[]" style="width: 120px" placeholder="Size"/>&nbsp;<input type="text" name="sku[]" style="width: 120px" placeholder="SKU"/>&nbsp;<input type="text" name="price[]" style="width: 120px" placeholder="Price"/>&nbsp;<input type="text" name="stock[]" style="width: 120px" placeholder="Stock"/><a href="javascript:void(0);" class="remove_button p-1" title="Remove field"><i class="fas fa-minus"></i></a></div>'; //New input field html
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
 });

 // $(".confirmDelete").click(function () {
 //     var name = $(this).attr("name");
 //     if(confirm("Are you sure to delete this " +name+ "?")){
 //         return true;
 //     }
 //     return false;
 // });

 //Confirmation Deletion with SweetAlert
 $(".confirmDelete").click(function () {
     var record = $(this).attr("record");
     var recordid = $(this).attr("recordid");
     Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
         if (result.value) {
             window.location.href="/admin/delete-"+record+"/"+recordid;
         }
     });
 });

 $(function () {
     $('[data-toggle="tooltip"]').tooltip()
 })
