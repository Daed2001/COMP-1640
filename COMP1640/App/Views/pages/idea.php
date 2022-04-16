<?php require APPROOT . '/Views/includes/header.php'; ?>
<?php require APPROOT . '/Views/includes/navigation.php'; ?>

<link rel="stylesheet" type="text/css" href="/App/Views/dist/css/media.css">
<link rel="stylesheet" type="text/css" href="/App/Views/dist/css/style.css">
<div class="container-fluid bground-container ">

    <!-- Post -->
    
   
<div class="row">
<div class="container">
<div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle category-btn" type="button" id='dropdownMenuButton'
            data-toggle="dropdown" aria-expanded="false">
            <?php echo ucfirst($data['type']) ?>
        </button>
        <div class="dropdown-menu  category_choose" aria-labelledby="dropdownMenuButton">
            <option class="dropdown-item category_item" onclick="choosecategory('lastest')">Lastest</option>
            <option class="dropdown-item category_item" onclick="choosecategory('popular')">Popular</option>

         

        </div>
</div>
        <div class="clearfix" style="text-align:center">
        
                <ul class="pagination">
                    
                    <?php if($data['curpage'] != $data['startpage']){ ?>
                    <li class="page-item">
                        <a class="page-link" href="/idea/index/<?php if (isset($data['type'])) {echo $data['type'].'/';}?><?php echo $data['startpage'] ?>" tabindex="-1"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">First</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if($data['curpage'] >= 2){ ?>
                    <li class="page-item"><a class="page-link"
                            href="/idea/index/<?php if (isset($data['type'])) {echo $data['type'].'/';}?><?php echo $data['previouspage'] ?>"><?php echo $data['previouspage'] ?></a>
                    </li>
                    <?php } ?>
                    <li class="page-item active"><a class="page-link"
                            href="/idea/index/<?php if (isset($data['type'])) {echo $data['type'].'/';}?><?php echo $data['curpage'] ?>"><?php echo $data['curpage'] ?></a></li>
                    <?php if($data['curpage'] != $data['endpage']){ ?>
                    <li class="page-item"><a class="page-link"
                            href="/idea/index/<?php if (isset($data['type'])) {echo $data['type'].'/';}?><?php echo $data['nextpage'] ?>"><?php echo $data['nextpage'] ?></a></li>
                    <li class="page-item">
                        <a class="page-link" href="/idea/index/<?php if (isset($data['type'])) {echo $data['type'].'/';}?><?php echo $data['endpage'] ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Last</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                    </div>
            
            <div  class="row">
                <div id='post-row' class="container">
                    <!-- User, Image and edit -->
                    <?php 
                
                   
                    foreach ($data['show'] as $row){
                  $idealid = $row['ideaId '];?>

                    <div class="row my-5 bg-light rounded-3">

                        <!-- Main content -->

                        <div class="col-md-12 mb-0 card pb-3">
                            <div class="card-header d-flex justify-content-between">
                                <div class="user-image ps-3 d-flex" align="center">
                                    <a href="">
                                        <img class="rounded-circle border align-self-start" id="img-user"
                                            src="/App/Views/dist/img/user2-160x160.jpg" alt="">
                                        <p class="bd-gray-300" style="margin-bottom: 0px;"><?php
                                                            if($row['Anonymous'] == 1){
                                                            echo "Anonymous";
                                                            } else{
                                                            foreach($data['user'] as $user){
                                                                if($user['userId'] == $row['userId']) {
                                                                    echo $user['username'];
                                                                }
                                                            };
                                                            };?>
                                        </p>
                                    </a>
                                    <p class="ml-3 mb-0"><small class="text-muted"><?php
                                                foreach($data['category'] as $category){
                                                    if($category['categoryId'] == $row['categoryId']){
                                                        echo 'Category: '.$category['categoryname'].'</small></p>';
                                                    };

                                                }?>
                                </div>


                                <div class="Voting d-flex align-self-end" style="position: absolute; right: 0;">
                                    <div id="up-down" style="display: grid; position: relative; bottom: 0.5rem;">
                                        <button onclick="update_count('voteup','<?php echo $row['ideaId'];?>')"
                                            id='up-<?php echo $row['ideaId'];?>'
                                            style="border: none; background: white;"><i
                                                class="fas fa-chevron-up interactive" style="font-size:24px"></i>
                                        </button>

                                        <button onclick="update_count('votedown','<?php echo $row['ideaId'];?>')"
                                            id='down-<?php echo $row['ideaId'];?>'
                                            style="border: none; background: white; "> <i
                                                class="fas fa-chevron-down interactive"
                                                style="font-size:24px"></i></button>

                                        <?php foreach($data['reaction'] as $reaction){
                                                            if ($reaction['ideaId'] == $row['ideaId'] && $reaction['userId'] == $_SESSION['user_id']){
                                                                if($reaction['reaction'] == 1){
                                                                        echo '<style type="text/css">   
                                                                        #up-'.$row['ideaId'].' {
                                                                            color: green;
                                                                        }
                                                                        </style>';
                                                                }elseif ($reaction['reaction'] == 0){
                                                                        echo '<style type="text/css">
                                                                        #down-'.$row['ideaId'].' {
                                                                            color: red;
                                                                        }
                                                                        </style>';
                                                                }
                                                                }
                                                            };?>

                                    </div>

                                    <p id="voting-num-<?php echo $row['ideaId'] ?>" class="px-2"
                                        style="margin-bottom: 0px;"><?php
                                            $totalvote = 0;
                                            foreach($data['reaction'] as $reaction){
                                                if ($reaction['ideaId'] == $row['ideaId']){
                                                    if($reaction['reaction'] == 1){
                                                        $totalvote +=1;
                                                    }if ($reaction['reaction'] == 0){
                                                        $totalvote -=1;
                                                    }
                                                }
                                            };
                                       echo $totalvote ?> Voted</p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                <div class="col-md-12 d-flex justify-content-between ">
                                    <h3 style="cursor: pointer;" data-toggle="modal"
                                        data-target="#post-view-<?php echo $row['ideaId']; ?>">
                                        <?php echo $row['Title'] ?></h3>
                                        </div>
                                </div>
                            </div>

                           
                            <div class="card-text">
                                <div class="col-md-12 pt-3 d-flex align-items-center justify-content-between ">
                                    <div class="ideal-post-time ">



                                        <p class="ps-1 mb-0 "><small class="text-muted"><?php
                                                    echo "Posted in ".strftime($row['createAt'])."- "; posttimeago($row['createAt']);
                                                    ?></small></p>
                                    </div>
                                    <div class="ideal-comment ">
                                        <a style="cursor: pointer;" data-toggle="modal"
                                            data-target="#post-view-<?php echo $row['ideaId'];?>"
                                            class=" d-flex justify-content-end">
                                            <i class="far fa-comment d-flex align-items-center"></i>
                                            <p class="mb-0 ps-1">Comment</p>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- End Main content -->
                        <!-- Bottom of content -->

                        <!-- End bottom of content -->
                    </div>

                    <div class="modal fade bd-example-modal-lg" id="post-view-<?php echo $row['ideaId'];?>"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <!-- Modal Ideal-->
                        <div class="modal-dialog modal-xl modal-idea-post">
                            <div class="modal-content">
                                <div class="modal-body row">
                                    <div class="col-lg-8">
                                        <div class="col-lg-12">
                                            <div class="row">
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
                                           
                                                    <div class="card mt-3">
                                                        <div class="row">
                                                        <div class="card-body">
                                                            <div class="col-sm-12">
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
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-sm-12 ">
                                                                <p class="mb-0">
                                                                    <?php  echo "Posted in " .date("d/m/Y",strtotime($row['createAt']))." - "; posttimeago($row['createAt']);?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                     
                                    <div class="col-lg-4 mt-3">
                                    <div class="col-lg-12">
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
                                            <?php foreach ($data['submission'] as $submission) {
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
                                                     <div class="d-flex">
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
                        </div>
                        <!-- End Modal Ideal-->
                        <!-- Modal comment-->
                        <!-- End Modal comment-->
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End Post -->
    </div>
    <script type="text/javascript" src="/App/Views/dist/js/pages/idea.js"></script>


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
    <!-- Myideal, ideals css -->
    <link rel="stylesheet" type="text/css" href="/App/Views/dist/css/style.css">
    <link rel="stylesheet" type="text/css" href="/App/Views/dist/css/media.css">

    <?php
        function Isusercheckvote($data,$ideaID){
            foreach($data['reaction'] as $reaction){
                if ($reaction['ideaId'] == $ideaID && $reaction['userId'] == $_SESSION['userId']){
                   if($reaction['reaction'] == 1){
                        echo '<style type="text/css">
                        #up-'.$ideaID.' {
                            color: green;
                        }
                        </style>';
                   }if ($reaction['reaction'] == 0){
                        echo '<style type="text/css">
                        #down-'.$ideaID.' {
                            color: red;
                        }
                        </style>';
                   }
                }
             };
        }
    
    
    ?>
 