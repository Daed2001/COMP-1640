<?php
require APPROOT . '/Views/includes/header.php';
?>
<?php
require APPROOT . '/Views/includes/navigation.php';
?>
<link rel="stylesheet" href="/App/Views/dist/css/crudidea.css">

<script type="text/javascript" src="/App/Views/dist/js/pages/myidea.js"></script>

<div class="container-fluid">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Ideas</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addIdeaModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Add New Ideas</span></a>
                        <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i
                                class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>Title</th>
                        <th>Anonymous</th>
                        <th>Category</th>
                        <th>Closure Date</th>
                        <th>Final Closure Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- In kết quả -->
                    <?php if ($_SESSION['role'] === '1') {
                  $show = $data['showadmin'];
               } else $show = $data['show'];
               foreach ($show as $row) {
               ?>
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="user_checkbox"
                                    data-user-id="<?php echo $row["ideaId"]; ?>">
                                <label for="checkbox1"></label>
                            </span>
                        </td>
                        <td><?php echo $row["Title"] ?> </td>
                        <td><?php If ($row["Anonymous"] == 1) {echo 'Yes' ;} else echo 'No'; ?> </td>
                        <td><?php echo $row["categoryname"] ?></td>
                        <td><?php echo $row["closure_date"] ?></td>
                        <td><?php echo $row["final_closure_date"] ?></td>
                        <td class="d-flex">

                            <a href="#postviewModal<?php echo $row['ideaId'];?>" 
                                data-toggle="modal">
                                <i data-toggle="tooltip" title="View" class="fas fa-eye"></i></a>
                                
                               <?php modalview($row,$data,$user) ?>
                            <a href="#editIdeaModal" class="edit" data-toggle="modal">
                                <i class="material-icons update" data-toggle="tooltip"
                                    data-id="<?php echo $row["ideaId"]; ?>" data-title="<?php echo $row["Title"]; ?>"
                                    data-content="<?php echo $row["Content"]; ?>"
                                    data-submission="<?php echo $row["submissionId"]; ?>"
                                    data-category="<?php echo $row["categoryId"]; ?>"
                                    data-file="/App/Views/dist/img/<?php echo $row["File"]; ?>"
                                    data-package="/App/Views/dist/img/<?php echo $row["Package"]; ?>"
                                    title="Edit">&#xE254;</i></a>

                            <a href="#deleteIdeaModal" data-id="<?php echo $row["ideaId"]; ?>" class="delete"
                                data-toggle="modal">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>

                        </td>
                    </tr>
                    



                    <?php }?>
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <?php if($data['curpage'] != $data['startpage']){ ?>
                    <li class="page-item">
                        <a class="page-link" href="/myidea/index/<?php echo $data['startpage'] ?>" tabindex="-1"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">First</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($data['curpage'] >= 2){ ?>
                    <li class="page-item"><a class="page-link"
                            href="/myidea/index/<?php echo $data['previouspage'] ?>"><?php echo $data['previouspage'] ?></a>
                    </li>
                    <?php } ?>
                    <li class="page-item active"><a class="page-link"
                            href="/myidea/index/<?php echo $data['curpage'] ?>"><?php echo $data['curpage'] ?></a></li>
                    <?php if($data['curpage'] != $data['endpage']){ ?>
                    <li class="page-item"><a class="page-link"
                            href="/myidea/index/<?php echo $data['nextpage'] ?>"><?php echo $data['nextpage'] ?></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="/myidea/index/<?php echo $data['endpage'] ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Last</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal HTML -->
<div class="modal fade" id="addIdeaModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Add Ideal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Add Ideal -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="titlepost_a" name="title-post" type="text" required="required"
                                class="form-control" placeholder="Title" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group col-md-12 my-3">
                           
                            <div class="card" id="img_postt" style="width:100%; display:none;">
                                <div class="card-header"> <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                        </button></div>
                                <div class="card-body " >
                                     <div class="d-flex justify-content-center" style="width:100%;">
                                        <div style="width:50%">
                                        <img src="" id="post_img" class="w-100 rounded border" alt="">
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="uploadfilebox d-flex" style="width:100%;">
                                <div class="custom-file col-lg-6">
                                    <input type="file" class="custom-file-input" name="img-post" id="select_post_img"
                                        aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="select_post_img">Choose picture</label>
                                </div>
                                    <div class="custom-file col-lg-6">
                                        <input type="file" class="custom-file-input" name="file-post[]" id="select_post_file"
                                            aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="select_post_file">Choose File Upload</label>
                                    </div>
                                
                            </div>
                            
                        </div>

                        <div class="col-md-12 mb-3">
                            <textarea id="textpost_a" class="form-control" name="text-post" aria-label="With textarea"
                                placeholder="Say something"></textarea>
                        </div>


                        <div class="col-md-12 d-flex justify-content-between d-block">
                            <div class="agreed-checkbox">
                                <div class="annonymous-check d-flex">
                                    <input class="mt-2 me-1" type="checkbox" id="anonymous" name="anonymous">
                                    <label for="anonymous">&nbsp; Do you want submit in anonymous </label>
                                    <br>
                                </div>

                                <div class="term-check d-flex">
                                    <input class="mt-2 me-1" type="checkbox" id="term" name="term" '>
                                       <label for="tearms_conditions">&nbsp; Agreed Tearms and Conditions</label>
                                       <br>
                                    </div>


                                 </div>
                                 <!-- Category checkbox -->
                                 <div class= "choose-checkbock">
                                 <div class="choose-category">
                                    <label for="cars">Category:</label>
                                    <select name="category" id="category_a">
                                       <?php
                                          foreach ($data['category'] as $row){
                                          echo '<option value="'.$row['categoryId'].'">'.$row['categoryname'].'</option>';
                                          }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="choose-submission">
                                    <label for="cars">Submission:</label>
                                    <select name="submission" id="submission_a">
                                       <?php
                                          foreach ($data['submissions'] as $row) { ?>
                                          <option closuredate="<?php echo $row['closure_date'] ?>" value="<?php echo $row['submissionId'] ?> "><?php echo $row['submissionname'] ?></option>
                                         <?php } ?>
                                    </select>
                                 </div> 

                                 </div>
                                      
                                
                                 
                                 
                              </div>

                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" value="Cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button id="btn-add" type="button" class="btn btn-primary">Add</button>
                        </div>

                     </form>
                        
                     </div>
                  </div>
               </div>
			   <div class="modal fade" id="editIdeaModal" tabindex="-1" >
                  <div class="modal-dialog modal-xl">
                     <div class="modal-content">
                     <form>
                        <div class="modal-header">
                           <h5 class="modal-title" >Edit Ideal</h5> 
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Edit Ideal -->
                         <div class="modal-body">
                           <div class="row">
                           <div class="col-md-12 my-3">
                                 <input type="hidden" id="id_u" name="id" class="form-control" required>	
                                 <input id="titlepost_u" name="title-post" type="text" required="required" class="form-control" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
                                
                                <div class="card" id="img_postt" style="width:100%;">
                                <div class="card-header"> <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                        </button></div>
                                <div class="card-body " >
                                     <div class="d-flex justify-content-center" style="width:100%;">
                                        <div style="width:50%">
                                         <img name="post_img_u" src=""  id="post_img_u" class="w-100 rounded border" style="display" alt="">
                                         <img name="post_img_ud" src=""  id="post_img_ud" class="w-100 rounded border" style="display" alt="">
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                             
                                </div>
                            <div class="uploadfilebox d-flex" style="width:100%;">
                                <div class="custom-file col-lg-6">
                                   <input type="file" class="custom-file-input" name="img-post" id="select_post_img_u" aria-describedby="inputGroupFileAddon01">
                                   <label class="custom-file-label" for="select_post_img">Choose picture</label>
                                </div>
                                    <div class="custom-file col-lg-6">
                                        <input type="file" class="custom-file-input" name="file-post" id="select_post_file"
                                            aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="select_post_file">Choose File Upload</label>
                                    </div>
                                
                            </div>
                           
                                                     
                   
                              <div class="col-md-12 d-flex justify-content-between d-block">
                                 <div class="agreed-checkbox">
                                    <div class="annonymous-check d-flex">
                                       <input class="mt-2 me-1" type="checkbox" id="anonymous_u" name="anonymous_u" >
                                       <label for="anonymous">&nbsp; Do you want submit in anonymous  </label>
                                       <br>
                                    </div>

                                    


                                 </div>
                                 <!-- Category checkbox -->
                                 <div class= "choose-checkbock">
                                 <div class="choose-category">
                                    <label for="cars">Category:</label>
                                    <select name="category" id="category_u">
                                       <?php
                                          foreach ($data['category'] as $row){
                                          echo '<option value="'.$row['categoryId'].'">'.$row['categoryname'].'</option>';
                                          }
                                       ?>
                                    </select>
                                 </div>
                                 <div class="choose-submission">
                                    <label for="cars">Submission:</label>
                                    <select name="submission" id="submission_u">
                                       <?php
                                          foreach ($data['submissions'] as $row){
                                          echo '<option value="'.$row['submissionId'].'">'.$row['submissionname'].'</option>';
                                          }
                                       ?>
                                    </select>
                                 </div> 

                                 </div>
                                      
                                
                                 
                                 
                              </div>

                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" value="Cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button id="btn-update" type="button" class="btn btn-primary">Update</button>
                        </div>

                     </form>
                        
                     </div>
                  </div>
               </div>
<!-- Delete Modal HTML -->
<div id="deleteIdeaModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete Idea</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-danger" id="delete">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- View Modal HTML -->
<?php
    function modalview($row,$data,$user){ ?>
        
            <div class="modal fade bd-example-modal-lg" id="postviewModal<?php echo $row['ideaId'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Modal Ideal-->
            <div class="modal-dialog modal-xl modal-idea-post">
                <div class="modal-content">
                    <div class="modal-body row">
                        <div class="col-lg-8">
                            <div class="col-lg-12">
                                <div class= "row">
                                         <div class="col-sm-8 mt-3">
                                                    <div class="card my-4 ">
                                                        <h6 class="card-header">Title</h6>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <h6 class="modal-title" id="exampleModalLongTitle">
                                                                    <?php echo $row['Title']; ?></h6>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 mt-3">
                                                    <div class="card my-4">
                                                        <h6 class="card-header">Category</h5>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <h6><?php  foreach($data['category'] as $category){
                                                                                if($category['categoryId'] == $row['categoryId']){
                                                                                    echo $category['categoryname'];
                                                                                };

                                                                            }?></h6>

                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                </div>
                               
                            </div>
                            <?php if(isset($row['File'])) { ?>
                                          <div class="IMAGE-content mt-3" style="100%;">
                                                <div class="card ">
                                                    <div class="card-header">


                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse" title="Collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class=" d-flex justify-content-center" style="width:100%;">
                                                            <img style="width:50%;" class="img-fluid rounded"
                                                                src="/App/Views/dist/img/<?php echo $row['File'] ?>"
                                                                class="card-img-top" alt="...">

                                                        </div>

                                                    </div>
                                                    <!-- /.card-body -->

                                                    <!-- /.card-footer-->
                                                </div>
                                                </div>
                                                <?php } ?>
                                                <div class="card mt-3">
                                                    <div class="card-body">
                                                    <div class="row">
                                                        <p> <?php echo $row['Content']; ?></p>
                                                    </div>
                                                </div>
                                              </div>
                                         
                                         
                                            <!-- /.card-body -->

                                            <!-- /.card-footer-->
                                            <?php if(isset($row['Package'])) { ?>
                                            <div class="card mt-3">
                                                        <div class="row">
                                                        <div class="card-body">
                                            <a href="www/wwwroot/206.189.84.57/App/Views/dist/file/<?php echo $row['Package'] ?>"
                                                download> <?php echo '<i class="bi bi-download mr-1"><svg style="margin-bottom: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg></i>'.$row['Package'].'';?></a>
                                                    </div>
                                           </div>
                                           </div>
                                           <?php } ?>
                                              <div class="row"> 
                                                 <div class="col-sm-12 mt-3">
                                                    <div class="card px-2 py-2"> 
                                                        <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p class="mb-0"> By - <?php if($row['Anonymous'] == 1){
                                                                    echo '<a href="#!">Anonymous</a>';
                                                                    
                                                                } else{
                                                                foreach($data['user'] as $user){
                                                                    if($user['userId'] == $row['userId']) {
                                                                        echo '<a href="#!">'.$user['username'].'</a>' ;
                                                                    }
                                                                };
                                                                }; ?></p>
                                                                </div>

                                                                <div class="col-sm-6 ">
                                                                    <p class="mb-0">
                                                                        <?php  echo "Posted in " .date("d/m/Y",strtotime($row['createAt']))." - "; posttimeago($row['createAt']);?>
                                                                    </p>
                                                                </div>

                                                            </div>
                                                    </div>
                                                 </div>
                                                                            
                                              </div>   
                            </div>
                            <div class="col-lg-4 ps-3">
                                    <div class="card px-2 py-2">
                                        <div class=" border-bottom mb-3 mt-2" style="color:blue;">
                                            <h4> Comment</h4>
                                            <div class="comment-show" value="<?php echo $row['ideaId'] ?>"
                                                name="comment-show" id="comment-show-<?php echo $row['ideaId'] ?>">
                                                <?php  
                                       foreach($data['comment'] as $comment){
                                          if($comment['ideaId'] == $row['ideaId']){?>
                                                <div class="media mb-4" style="color:black">
                                                    <img class="rounded-circle border align-self-start mr-3"
                                                        id="img-user" src="/App/Views/dist/img/user2-160x160.jpg"
                                                        alt="">
                                                    <div class="media-body">
                                                        <h5 class="mt-0"> <?php
                                             if( $comment['Anonymous'] == 1){
                                                   echo "Anonymous";
                                             }else{
                                                   echo $comment['username'];
                                             }; 
                                             ?>
                                                        </h5>
                                                        <p><?php echo $comment['Content'] ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                       }
                                       }
                                       ?>
                                            </div>
                                        </div>
                                        <div id="comment_form">
                                            <?php foreach ($data['submiss'] as $submission) {
                                                if($row['submissionId'] == $submission['submissionId']){
                                                    if(strtotime($submission['final_closure_date'] )> strtotime(date("y.m.d"))){?>
                                            <div class="input-group p-2 ">
                                                <div class="input col-sm-12 d-flex">
                                                    <img class="rounded-circle border align-self-start mr-3"
                                                        id="img-user" src="/App/Views/dist/img/user2-160x160.jpg"
                                                        alt="">
                                                    <input type="text"
                                                        class="form-control rounded-0 border-0 comment-input"
                                                        name="comment" id="comment" placeholder="say something.." />
                                                    <input type="hidden" name="ideaid" class="ideaid" id="ideaid"
                                                        value="<?php echo $row['ideaId']; ?>" />
                                                    <button
                                                        class="btn btn-outline-primary  rounded-0 border-0 add-comment"
                                                        data-cs="comment-show-<?php echo $row['ideaId']; ?>">Post</button>
                                                </div>

                                                <div class="annonymous-check col-sm-12 d-flex ml-5 mt-1">
                                                    <input class="mt-2 mr-1 anonymouss" class="anonymouss"
                                                        type="checkbox" id="anonymouss" name="anonymouss" checked="true"
                                                        value="1">
                                                    <label for="anonymous"> Do you want submit in anonymous </label>
                                                    <br>
                                                </div>
                                            </div>
                                            <?php }else{?>

                                            <div class="input-group p-2 ">
                                                <div class="input col-sm-12 d-flex">
                                                    <img class="rounded-circle border align-self-start mr-3"
                                                        id="img-user" src="/App/Views/dist/img/user2-160x160.jpg"
                                                        alt="">
                                                    <input type="text"
                                                        class="form-control rounded-0 border-0 comment-input"
                                                        name="comment" id="comment" placeholder="Out final closure date"
                                                        readonly />
                                                    <input type="hidden" name="ideaid" class="ideaid" id="ideaid"
                                                        value="<?php echo $row['ideaId']; ?>" />
                                                    <button
                                                        class="btn btn-outline-primary  rounded-0 border-0 lock-comment"
                                                        data-cs="comment-show-<?php echo date("d.m.y") ?>">Post</button>
                                                </div>

                                                <div class="annonymous-check col-sm-12 d-flex ml-5 mt-1">
                                                    <input class="mt-2 mr-1 anonymouss" class="anonymouss"
                                                        type="checkbox" id="anonymouss" name="anonymouss" checked="true"
                                                        value="1">
                                                    <label for="anonymous"> Do you want submit in anonymous </label>
                                                    <br>
                                                </div>
                                            </div>
                                            <?php }
                                                } 

                                            }
                                            
                                            ?>

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <!-- End Modal Ideal-->
            <!-- Modal comment-->
            <!-- End Modal comment-->
            </div>
    <?php }
?>



<?php
       function posttimeago($timeagopost){
         $timeago = strtotime($timeagopost);
         $currenttime = time();
         $time_difference= $currenttime -  $timeago;
         $seconds =  $time_difference;
         $minutes = round($seconds / 60);
         $hours = round($seconds / 3600);
         $days = round($seconds / 86400);
         $weeks = round($seconds / 604800);
         $months = round($seconds / 2629440);
         $years = round($seconds / 31553280);
         if($seconds <= 60){
            echo "Just for now";
         } else if($minutes <= 60){
            if($minutes == 1){
               echo "one minute ago";
            }else{
               echo  $minutes." minutes ago";
            }
         }elseif  ($hours <=24){
            if($hours == 1){
               echo "an hour ago";
            }else{
               echo  $hours." hours ago";
            }
         }elseif  ($days <=7){
            if($days == 1){
               echo "yesterday";
            }else{
               echo $days." days ago";
            }
         }elseif  ($weeks <=4.3){
            if($weeks == 1){
               echo "a week ago";
            }else{
               echo $weeks." weeks ago";
            }
         }elseif  ($months <=12){
            if($months == 1){
               echo "a month ago";
            }else{
               echo $months." months ago";
            }
         }else{
            if($years == 1){
               echo "a year ago";
            }else{
               echo  $years." years ago";
            }
         }
       }
      ?>