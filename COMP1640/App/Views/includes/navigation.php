
<nav class="navbar navbar-expand-sm navbar-white navbar-light">
  <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsMain" aria-controls="navbarsMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="navbar-collapse collapse" id="navbarsMain">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/dashboard/index" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/idea/index" class="nav-link">Ideas</a>
      </li>
      <?php if($_SESSION['role'] === '1' || $_SESSION['role'] === '2'){ ?>
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/department/index" class="nav-link">Department</a>
      </li>
      <?php } ?>
      <?php if($_SESSION['role'] === '1' || $_SESSION['role'] === '3'){ ?>
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/category/index" class="nav-link">Categories</a>
      </li>
      <?php } ?>
      <?php if($_SESSION['role'] === '1'){ ?>
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/submission/index" class="nav-link">Submissions</a>
      </li>
      <?php } ?>
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/myidea/index" class="nav-link">My Ideas</a>
      </li>
      <?php if($_SESSION['role'] === '1'){ ?>
      <li class="nav-item">
      <a href="<?php echo URLROOT;?>/staff/index" class="nav-link">Staff</a>
      </li>
      <?php } ?>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="/App/Views/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"> <?php echo ($_SESSION['username'])?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="<?php echo URLROOT?>/App/Views/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

            <p>
             <?php echo ($_SESSION['username'])?>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="<?php echo URLROOT;?>/Profile/index " class="btn btn-default btn-flat"> Profile</a>
            <?php if(isset($_SESSION['user_id'])) : ?>
            <a href="<?php echo URLROOT; ?>/users/logout" class="btn btn-default btn-flat float-right">Sign out</a>
            <?php else : ?>
            <?php header('location:' . URLROOT . '/users/login'); ?>
            <?php endif; ?>
          </li>
        </ul>
      </li>
      </div>
    </ul>
            </div>
  </nav>
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $data["title"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $data["title"] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
            </body>