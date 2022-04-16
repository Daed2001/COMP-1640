$(document).on("click","#btn-add",function(e) {
    $.ajax({
        data: {
            type:('create'),
            name:$("#name_a").val()
        },
        type: "post",
        url: "/category/create",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                console.log(name);
                if(dataResult.statusCode==200){
                    $('#addcategoryModal').modal('hide');
                    alert('Data added successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert('Please fill in !');
                } else if (dataResult.statusCode=='categorycheck') {
                    alert('Category already exist !');
                }

        }
    });
});

$(document).on('click','.update',function(e) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    $('#id_u').val(id);
    $('#name_u').val(name);
    
});
$(document).on('click','#update',function(e) {
    $.ajax({
        url: "/category/update",
        type: "POST",
          data: {
            type:('update'),
            id:$('#id_u').val(),
            name:$('#name_u').val(),
            },
          success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#addcategoryModal').modal('hide');
                    alert('Data upload successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert('Please fill in !');
                } else if (dataResult.statusCode=='categorycheck') {
                    alert('Category already exist !');
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
        url: "/category/delete",
        type: "POST",
        cache: false,
        data:{
            type:('delete'),
            id:$("#id_d").val()
        },
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                $('#deletecategoryModal').modal('hide');
                alert('Data delete successfully !');
                location.reload();
                }	  else if(dataResult.statusCode==201){
                    alert('Category have ideas on it !');
                    
                } 
                
        
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
                url: "/category/deletemultiple",
                cache:false,
                data:{
                    type: ('deletemultiple'),						
                    id : selected_values
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        alert('Data delete successfully !');
                        location.reload();
                        }	 else if(dataResult.statusCode==201){
                            alert('Category have ideas on it !');
                            
                        } 
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

function Alert(message) {
$('#alert-e').append(
    '<div class="alert alert-danger" role="alert">' + message + '</div>');
}


