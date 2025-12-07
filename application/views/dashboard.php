  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <?php if($is_admin == true): ?>
      <div class="row">

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total_slots; ?></h3>

              <p>Total Parking Slots</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('slots') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $total_users; ?></h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?php echo base_url('users') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $total_parking; ?></h3>

              <p>Total Parking</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url('parking') ?>" class="small-box-footer">More Info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
  <div class="small-box bg-red">
    <div class="inner">
      <h3><?php echo $page_access_count; ?></h3>
      <p>Page Access Count</p>
    </div>
    <div class="icon">
      <i class="ion ion-eye"></i>
    </div>
    <a href="#" class="small-box-footer">Updated in real-time</a>
  </div>
</div>

        

      </div>
      <!-- /.row -->
      <?php endif; ?>
      
<?php if($is_admin == true): ?>
<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Parking Statistics</h3>
      </div>
      <div class="box-body">
        <canvas id="parkingChart"></canvas>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="parkingChart" height="120"></canvas>

<script>
document.addEventListener("DOMContentLoaded", function () {

    var ctx = document.getElementById('parkingChart').getContext('2d');

    var parkingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Statistik'],
            datasets: [
                {
                    label: 'Total Slots',
                    data: [<?php echo $total_slots; ?>],
                    backgroundColor: 'rgba(0, 123, 255, 0.6)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Users',
                    data: [<?php echo $total_users; ?>],
                    backgroundColor: 'rgba(255, 193, 7, 0.6)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Parking',
                    data: [<?php echo $total_parking; ?>],
                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Page Access Count',
                    data: [<?php echo $page_access_count; ?>],
                    backgroundColor: 'rgba(220, 53, 69, 0.6)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>


