$(document).ready(function(){
var input = document.querySelector("#select_post_img");

input.addEventListener("change", preview);

function preview(){
    var fileobject = this.files[0];
    var filereader = new FileReader();

    filereader.readAsDataURL(fileobject);

    filereader.onload = function(){
        var image_src = filereader.result;
        var image = document.querySelector('#post_img');
        var imagepost= document.querySelector('#img_postt');
        image.setAttribute('src',image_src);
        imagepost.setAttribute('style','display: block; width:100%;');  

  
    }


}

// var input = document.querySelector("#select_post_file");
// input.addEventListener("change", preview);
// function preview(){
//     var fileobject = this.files[0];
//     var filereader = new FileReader();

//     filereader.readAsDataURL(fileobject);

//     filereader.onload = function(){
//         var post_src = filereader.result;
//         var post = document.querySelector('#post_file');
//         post.setAttribute('src',image_src);
//         post.setAttribute('style','display:');
//         $('#post_file').val(cateogry);
//     }
// }


var input_u = document.querySelector("#select_post_img_u");

input_u.addEventListener("change", preview_u);

function preview_u(){
    var fileobject_u = this.files[0];
    var filereader_u = new FileReader();

    filereader_u.readAsDataURL(fileobject_u);

    filereader_u.onload = function(){
        var image_src_u = filereader_u.result;
        var image_u = document.querySelector('#post_img_u');
        image_u.setAttribute('src',image_src_u);
        image_u.setAttribute('style','display:');
        $('#post_img_ud').remove();
    }
}
});

$(document).on("click","#btn-add",function(e) {
     
    var form_data = new FormData();
    form_data.append('imgpost', $('#select_post_img')[0].files[0]);
    form_data.append('titlepost', $("#titlepost_a").val());
    form_data.append('textpost', $("#textpost_a").val());
    form_data.append('anonymouss', $("#anonymous").is( ":checked" ) ? 1 : 0);
    form_data.append('term', $("#term").is( ":checked" ) ? 1 : 0);
    form_data.append('category', $("#category_a").val());
    form_data.append('submission', $("#submission_a").val());
    form_data.append('closure_date', $("#submission_a option:selected").attr("closuredate"));
    form_data.append('type', 'create');
    form_data.append('package', $('#select_post_file')[0].files[0]);
  $.ajax({
        data: form_data,
        cache       : false,
        contentType : false,
        processData : false,
        type: "post",
        url: "/myidea/create",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                console.log(dataResult);
                if(dataResult.statusCode==200){
                    $('#addIdeaModal').modal('hide');
                    alert('Data added successfully !'); 
                    location.reload();		
                }else if(dataResult.statusCode=="errimage"){
                    alert("Sorry picture not allowed, only JPG, JPEG, PNG & GIF are allowed.")
                }else if(dataResult.statusCode=="errfile"){
                    alert("Sorry file not allowed, only zip, rar, docx, pdf & doc are allowed.")
                }
                else if(dataResult.statusCode==201){
                    alert('Please fill in !');
                } else if  (dataResult.statusCode=='tos') {
                    alert('Please agree to Terms and Conditions');
                } else if (dataResult.statusCode=='closuredate') {
                    alert('Closure date is overdue');
                }
        }
    });


});

$(document).on('click','.update',function(e) {
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    var content = $(this).attr("data-content");
    var submission = $(this).attr("data-submission");
    var cateogry = $(this).attr("data-category");
    var file = $(this).attr("data-file");
    var package = $(this).attr("data-package");
    $('#id_u').val(id);
    $('#titlepost_u').val(title);
    $('#textpost_u').val(content);
    $('#category_u').val(cateogry);
    $('#submission_u').val(submission);
    $("#post_img_ud").attr("src", file);

    
});
$(document).on('click','#btn-update',function(e) {

    var form_data = new FormData();
    form_data.append('imgpost', $('#select_post_img_u')[0].files[0]);
    form_data.append('titlepost', $("#titlepost_u").val());
    form_data.append('textpost', $("#textpost_u").val());
    form_data.append('anonymouss', $("#anonymous_u").is( ":checked" ) ? 1 : 0);
    form_data.append('category', $("#category_u").val());
    form_data.append('submission', $("#submission_u").val());
    form_data.append('type', 'update');
    form_data.append('ideaId', $("#id_u").val());
    $.ajax({
        url: "/myidea/update",
        type: "POST",
        data: form_data,
        cache       : false,
        contentType : false,
        processData : false,
          success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#editIdeaModal').modal('hide');
                    alert('Data update successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                    alert('Please fill in !');
                    
                } 
        },
    });
});

$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);	
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "/myidea/delete",
        type: "POST",
        cache: false,
        data:{
            type:('delete'),
            id:$("#id_d").val()
        },
        success: function(){
                $('#deleteIdeaModal').modal('hide');
                alert('Data delete successfully !');
                location.reload();	
                
        
        }
    });
});
$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if(user.length <=0) {
        alert("Please select records."); 
    } 
    else { 
        WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "/myidea/deletemultiple",
                cache:false,
                data:{
                    type: ('deletemultiple'),						
                    id : selected_values
                },
                success: function(response) {
                console.log(response);
                alert('Data delete successfully !');
                location.reload();
                } 
            }); 
        }  
    } 
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});


       
$(document).on("click", ".anonymouss", function(e) {
    var thisClicked = $(this);
    var anonymouss = thisClicked.closest('.input-comment-group').find('.anonymouss').val();
    if (thisClicked.prop("checked") == true) {
        anonymouss = 1;
        $('.anonymouss').val(anonymouss);
    } else if (thisClicked.prop("checked") == false) {
        anonymouss = 0;
        $('.anonymouss').val(anonymouss);
    }
 });
 
 // ADD COMMENT
$(document).on("click", ".add-comment", function(e) {
    e.preventDefault();
    var thisClicked = $(this);
    var cs = thisClicked.data('cs');
 
    $.ajax({
 
    })
    var cmt_id = thisClicked.closest('.input-group').find('.ideaid').val();
    var comment_content = thisClicked.closest('.input-group').find('.comment-input').val();
    var anonymouss = thisClicked.closest('.input-group').find('.anonymouss').val();
    var data = {
        'idea_id': cmt_id,
        'comment_content': comment_content,
        'anonymouss': anonymouss,
    }
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '/Comment/add',
        data: data,
        success: function(response) {
            console.log(response.comment);
            $("#" + cs).prepend(response.comment);
            if(response.status){
                alert(response.status);
            }
           
        }
 
    });
 });
 



