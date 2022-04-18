<?php
   require APPROOT . '/Views/includes/header.php';
?>
<?php
    require APPROOT . '/Views/includes/navigation.php';
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="/App/Views/dist/css/crud.css">

<div class="content" style="min-height: 1491.44px;">

    <!-- Main content -->
    <section class="content">

      <!-- Number of Ideas -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Number of ideas made by each Department</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            </button>
          </div>
        </div>
        <div class="card-body">
        <div style=" position: relative;height:40vh; width:100vw" >
  <canvas  id="ideadepartment"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>
<!-- Percent of Ideas -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Percentage of ideas by each Department</h3>
       
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            </button>
          </div>
        </div>
        <div class="card-body">
        <div style=" position: relative;height:40vh; width:100vw" >
  <canvas id="percent"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
       
        <!-- /.card-footer-->
      </div>

      <!-- Contributor of Department -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Number of contributors within each Department</h3>
       
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            </button>
          </div>
        </div>
        <div class="card-body">
        <div style=" position: relative;height:40vh; width:100vw" >
  <canvas id="contributor"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>



      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Number of Idea without comment : <?php echo $data['noideacount'][0]['cnt'] ?></h3>
       
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Idea name</th>
					</tr>
				</thead>
				<tbody>
					<!-- In kết quả -->
			<?php foreach ($data['noidea'] as $row) {
				?>
				<tr>

						<td><?php echo $row["Title"]?> </td>
					</tr> 
			<?php }?>
				</tbody>
			</table></canvas>
          </div>
        </div>
        <!-- /.card-body -->
       
        <!-- /.card-footer-->

        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Anonymous Ideas and Comments</h3>
       
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Anonymous Idea : <?php echo $data['anonyideacount'][0]['cnt']?></th>
            <th>Anoynymous Comment : <?php echo $data['anonycommentcount'][0]['cnt']?></th>
					</tr>
				</thead>
				<tbody>
        <?php foreach ($data['anonycomment'] as $row => $value) {
				?>
				<tr>
						<td><?php echo $data['anonyidea'][$row]["Title"]?> </td>
            <td><?php echo $data['anonycomment'][$row]["Content"]?> </td>
					</tr> 
			<?php }?>
				</tbody>
			</table></canvas>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  

<?php
  foreach($data['ideadepartment'] as $row)
  {
    $department[] = $row['departmentname'];
    $ideas[] = $row['cnt'];
    $percentideas[] = floatval($row['cnt']) / floatval($data['ideacount']) * 100;
  } 
  foreach($data['contributor'] as $row) 
  {
    $departmentname[] = $row['departmentname'];
    $contributor[] = $row['cnt'];
  }

?>
  <script>
// number idea chart 
  const labels = <?php echo json_encode($department) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Number of ideas',
      data: <?php echo json_encode($ideas) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      maintainAspectRatio: false,
    },
  };
  var ideadepartment = new Chart(
    document.getElementById('ideadepartment'),
    config
  );

// percent chart

  const labels2 = <?php echo json_encode($department) ?>;
  const datapercent = {
    labels: labels2,
    datasets: [{
      label: 'Percentage of ideas',
      data: <?php echo json_encode($percentideas) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config2 = {
    type: 'pie',
    data: datapercent,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      maintainAspectRatio: false,
    },
  };


  var percent = new Chart(
    document.getElementById('percent'),
    config2
  );

  // contributor chart

  const labels3 = <?php echo json_encode($departmentname) ?>;
  const datacontributor = {
    labels: labels3,
    datasets: [{
      label: 'Number of Contributor',
      data: <?php echo json_encode($contributor) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config3 = {
    type: 'bar',
    data: datacontributor,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      maintainAspectRatio: false,
    },
  };


  var contributor = new Chart(
    document.getElementById('contributor'),
    config3
  );

 
</script>
