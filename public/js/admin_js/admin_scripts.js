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
