<?php
   require APPROOT . '/Views/includes/header.php';
?>
<?php
    require APPROOT . '/Views/includes/navigation.php';
?>
<script> 
$(document).on('click','#update',function(e) {
    $.ajax({
        url: "/user/update",
        type: "POST",
          data: {
            type:('update'),
            id:$('#id').val(),
            username:$("#username").val(),
            password:$("#password").val(),
            email:$("#email").val(),
            fullname:$("#fullname").val(),
            role:$("#role").val(),
            department:$("#department").val()
            },
          success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    alert('Data update successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                    alert('Please fill in !');
                    }
                
        },
    });
});
</script>

<div class="container">
<div class="row">
<div class="col-md">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_SESSION['user_id'] ?>"required>
                  <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" class="form-control" id="email" value="<?php echo $data['user']->email ?>"  placeholder="<?php echo $data['user']->email ?>" >
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="<?php echo $data['user']->username ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" value="<?php echo $data['user']->fullname?>" placeholder="<?php  $data['user']->fullname ?>" >
                  </div>
                  <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" class="form-control" id="department"  placeholder="<?php echo $data['user']->departmentname?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" id="role" placeholder="<?php echo $data['user']->rolename ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter new password" >
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button id="update" type="button" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
</div>
</div>

</div>



