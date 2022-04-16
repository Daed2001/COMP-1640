<?php require APPROOT . '/Views/includes/header.php'; ?>
<?php require APPROOT . '/Views/includes/navigation.php'; ?>
<script> $().dropdown('update')</script>
<script type="text/javascript" src="/App/Views/dist/js/pages/myidea.js"></script>
<body>
   <link rel="stylesheet" href="">
   <div class="container-fluid bground-container ">
      <!-- Category and Add Ideal -->
      <div class="container">
         <div class="row">
            <div class="col-md-12 d-flex justify-content-between mt-3">
             <div class="dropdown">
               <button class="btn btn-secondary dropdown-toggle category-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  Category
               </button>
               <div class="dropdown-menu  category_choose" aria-labelledby="dropdownMenuButton">
               <?php
                        foreach ($data['category'] as $row){
                        echo '<option  class="dropdown-item category_item" onclick="dropdowncategory(';echo "'".$row['categoryname']."'"; echo')">'.$row['categoryname'].'</option >';
                        
                        }
               ?>
                 
               </div>
               </div>
               <!-- Button trigger modal -->
               <a href="#addIdeaModal" class="btn btn-primary" data-toggle="modal">Add Ideal</a>
               <!-- AddIdeaModal -->
               <div class="modal fade" id="addIdeaModal" tabindex="-1" >
                  <div class="modal-dialog modal-xl">
                     <div class="modal-content">
                     <form>
                        <div class="modal-header">
                           <h5 class="modal-title" >Add Ideal</h5> 
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Add Ideal -->
                         <div class="modal-body">
                           <div class="row">
                           <div class="col-md-12">
                                 <input id="titlepost_a" name="title-post" type="text" required="required" class="form-control" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           <div class="input-group col-md-12 my-3">
                              <img src=""  id="post_img" class="w-100 rounded border" style="display:none;" alt="">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" name="img-post" id="select_post_img" aria-describedby="inputGroupFileAddon01">
                                 <label class="custom-file-label" for="select_post_img">Choose picture</label>
                              </div>
                           </div>

                              <div class="col-md-12 mb-3">
                              <textarea id="textpost_a" class="form-control" name="text-post" aria-label="With textarea" placeholder="Say something"></textarea>
                              </div>
                                                     
                   
                              <div class="col-md-12 d-flex justify-content-between d-block">
                                 <div class="agreed-checkbox">
                                    <div class="annonymous-check d-flex">
                                       <input class="mt-2 me-1" type="checkbox" id="anonymous" name="anonymous" >
                                       <label for="anonymous"> Do you want submit in anonymous </label>
                                       <br>
                                    </div>

                                    <div class="term-check d-flex">
                                       <input class="mt-2 me-1" type="checkbox" required="required" id="agreed_tearm" name="agreed_tearm" checked="true" value='1'>
                                       <label for="tearms_conditions"> Agreed Tearms and Conditions</label>
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
                           <button id="btn-add" type="button" class="btn btn-primary">Add</button>
                        </div>

                     </form>
                        
                     </div>
                  </div>
               </div>
               <!-- EditIdeaModal -->
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
                           <div class="col-md-12">
                                 <input id="titlepost_u" name="title-post" type="text" required="required" class="form-control" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                           <div class="input-group col-md-12 my-3">
                              <img name="post_img_u" src=""  id="post_img_u" class="w-100 rounded border" style="display" alt="">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" name="img-post" id="select_post_img_u" aria-describedby="inputGroupFileAddon01">
                                 <label class="custom-file-label" for="select_post_img">Choose picture</label>
                              </div>
                           </div>

                              <div class="col-md-12 mb-3">
                              <textarea id="textpost_u" class="form-control" name="text-post" aria-label="With textarea" placeholder="Say something"></textarea>
                              </div>
                                                     
                   
                              <div class="col-md-12 d-flex justify-content-between d-block">
                                 <div class="agreed-checkbox">
                                    <div class="annonymous-check d-flex">
                                       <input class="mt-2 me-1" type="checkbox" id="anonymous" name="anonymous" >
                                       <label for="anonymous"> Do you want submit in anonymous </label>
                                       <br>
                                    </div>

                                    <div class="term-check d-flex">
                                       <input class="mt-2 me-1" type="checkbox" required="required" id="agreed_tearm" name="agreed_tearm" checked="true" value='1'>
                                       <label for="tearms_conditions"> Agreed Tearms and Conditions</label>
                                       <input type="hidden" id="id_u" name="id" class="form-control" required>
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
            </div>
         </div>
      </div>
                <!-- Category and Add Ideal -->
            <!-- Post -->
      <div class="container">
         <div class="row">
            <div class="container">
                <!-- User, Image and edit -->
               <div class="col" id="post-ideal">
                  <div class="row pt-2 my-5 bg-light rounded-3">
                     <div class="col-md-12 pt-2 d-flex justify-content-between">
                        <div class="user-image ps-3" align="center">
                           <a href="">
                              <img id="img-user"  src="/App/Views/dist/img/user2-160x160.jpg" alt="">
                              <p class="bd-gray-300">Anonymous</p>
                           </a>

                        </div>

                        <div class="dropdown pe-3">
                           <p class="fs-5" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                              ...
                           </p>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="#">Edit</a>
                              </li>
                              <li><a class="dropdown-item" href="#">Delete</a>
                              </li>
                              <li><a class="dropdown-item" href="#">Something else here</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                        <!-- Main content -->
                        <div class="row justify-content-center">
                           <div class="col-md-12  pt-2">
                           <div class="card px-2 mx-3">
                              <div class="card-header">This is a title</div>
                              <h2 class="card-title pb-3"></h2>
                              <img src="/App/Views/dist/img/photo1.png" class="card-img-top" alt="...">
                              <div class="card-body">
                                 <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                              </div>
                           </div>
                        </div>
                        </div>
                     
                         <!-- End Main content -->

                         <!-- Bottom of content -->
                     <div class="col-md-12 pe-5 pb-2 d-flex align-items-center justify-content-between ">
                        <div class="ideal-post-time d-flex justify-content-start">

                           <p class="ps-1 mb-0 ">Posted in 21/21/2021</p>
                        </div>

                        <div class="ideal-comment ">
                           <a class=" d-flex justify-content-end" href="">
                              <i class="far fa-comment d-flex align-items-center"></i>
                              <p class="mb-0 ps-1">Comment</p>
                           </a>

                        </div>
                     </div>
                         <!-- End bottom of content -->
                  </div>
               
               </div>
              <?php  foreach ($data['show'] as $row){ 
                 $img_folder="/App/Views/dist/img/";
                 ?>
                
                <div class="col" id="post-ideal">
                <div class="row pt-2 my-5 bg-light rounded-3">
                   <div class="col-md-12 pt-2 d-flex justify-content-between">
                      <div class="user-image ps-3" align="center">
                         <a href="">
                            <img id="img-user" src="<?php echo$img_folder?>user2-160x160.jpg" alt="">
                            <p class="bd-gray-300">Anonymous</p>
                         </a>

                      </div>

                      <div class="dropdown pe-3">
                         <p class="fs-5" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                            ...
                         </p>

                         <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                               <a href="#editIdeaModal" class="edit" data-toggle="modal">
                                  <i class="material-icons update" data-toggle="tooltip"
									data-id="<?php echo $row["ideaId"]; ?>"
									data-title="<?php echo $row["Title"]; ?>"
									data-content="<?php echo $row["Content"]; ?>" 
									data-submission="<?php echo $row["submissionId"]; ?>"
									data-category="<?php echo $row["categoryId"]; ?>"
									data-file="<?php echo URLROOT ?>/App/Views/dist/img/<?php echo $row["File"]; ?>" 
									title="Edit">&#xE254;</i>Edit</a>
                            </li>
                              <li name="<?php echo $row["Title_id"] ?>"><a class="dropdown-item" href="#">Delete</a>
                                 </li>
                            <li><a class="dropdown-item" href="#">Something else here</a>
                            </li>
                         </ul>
                      </div>
                   </div>
                      <!-- Main content -->
                      <div class="row justify-content-center"> 
                   <div class="col-md-12 ">
                      <div class="card px-2 mx-3">
                         <div class="card-header"><?php echo $row["Title"] ?></div>
                         <h2 class="card-title pb-3"></h2>
                         <div class="col-md-12">
                         <img src="<?php echo $img_folder ?><?php echo $row["File"] ?>" class="card-img-top" alt="...">
                         </div>
                        
                         <div class="card-body">
                            <p class="card-text"><?php echo$row["Content"] ?></p>
                         </div>
                      </div>
                   </div>
                   </div>
                       <!-- End Main content -->

                       <!-- Bottom of content -->
                   <div class="col-md-12 pe-5 pb-2 d-flex align-items-center justify-content-between ">
                      <div class="ideal-post-time d-flex justify-content-start">

                         <p class="ps-1 mb-0 ">Posted in <?php echo $row["createAt"] ?></p>
                      </div>

                      <div class="ideal-comment ">
                         <a class=" d-flex justify-content-end" href="">
                            <i class="far fa-comment d-flex align-items-center"></i>
                            <p class="mb-0 ps-1">Comment</p>
                         </a>

                      </div>
                   </div>
                       <!-- End bottom of content -->
                </div>

             </div>

              <?php }  ?>
               
          

            </div>
         </div>
      </div>
         <!-- End Post -->
   </div>
   </div>
   
</body>

</html>