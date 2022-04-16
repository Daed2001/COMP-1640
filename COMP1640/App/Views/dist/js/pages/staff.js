$(document).on("click","#btn-add",function(e) {
    $.ajax({
        data: {
            type:('create'),
            username:$("#username_a").val(),
            password:$("#password_a").val(),
            email:$("#email_a").val(),
            fullname:$("#fullname_a").val(),
            role:$("#role_a").val(),
            department:$("#department_a").val()
        },
        type: "post",
        url: "/staff/create",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                console.log(dataResult);

                if(dataResult.statusCode==200){
                    $('#addStaffModal').modal('hide');
                    alert('Data added successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert('Please fill in !');
                } else if (dataResult.statusCode=='staffcheck') {
                    alert('Staff already exist !');
                }       
        }
    });
});

$(document).on('click','.update',function(e) {
    var id = $(this).attr("data-id");
    var username = $(this).attr("data-username");
    var email = $(this).attr("data-email");
    var fullname = $(this).attr("data-fullname");
    var role = $(this).attr("data-role");
    var department = $(this).attr("data-department");

    $('#id_u').val(id);
    $('#username_u').val(username);
    $('#email_u').val(email);
    $('#fullname_u').val(fullname);
    $('#role_u').val(role);
    $('#department_u').val(department);

    
});
$(document).on('click','#update',function(e) {
    $.ajax({
        url: "/staff/update",
        type: "POST",
          data: {
            type:('update'),
            id:$('#id_u').val(),
            username:$("#username_u").val(),
            password:$("#password_u").val(),
            email:$("#email_u").val(),
            fullname:$("#fullname_u").val(),
            role:$("#role_u").val(),
            department:$("#department_u").val()
            },
          success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#editStaffModal').modal('hide');
                        alert('Data update successfully !'); 
                        location.reload();						
                    }
                    else if(dataResult.statusCode==201){
                       alert('Please fill in !');
                    } else if (dataResult.statusCode=='staffcheck') {
                        alert('Staff already exist !');
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
        url: "/staff/delete",
        type: "POST",
        cache: false,
        data:{
            type:('delete'),
            id:$("#id_d").val()
        },
        success: function(){
                $('#deleteStaffModal').modal('hide');
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
                url: "/staff/deletemultiple",
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

function Alert(message) {
$('#alert-e').append(
    '<div class="alert alert-danger" role="alert">' + message + '</div>');
}


