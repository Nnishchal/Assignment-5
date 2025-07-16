<?php
    if (strtolower($_SESSION['username']) !== 'admin') {
        header('Location: /home');
        exit;
    }
    $reminders = $reminders ?? []; 
    $most_reminders = $most_reminders ?? '';
    $login_attempts = $login_attempts ?? [];
    $reminder_count = $reminder_count ?? [];
?>
<?php require_once 'app/views/templates/header.php'?>
<div class="container my-4">
  <div class="page-header" id="banner">
    <div class="row">
      <h2 class="fw-bolder"><span class="text-decoration-underline">Reports</span> 📝</h2>  
      <div class="col-lg-6 mt-4">
        <h2>Reminders Report</h2>
        <div class="card m-3 p-3">
          <table class="table table-bordered table-striped mt-4">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Creator</th>
                <th>Deadline</th>  
              </tr>
            </thead>
            <tbody>
              <?php foreach ($reminders as $index => $reminder): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= htmlspecialchars($reminder['title']) ?></td>
                  <td><?= htmlspecialchars($reminder['user']) ?></td>
                  <td><?= htmlspecialchars($reminder['deadline']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>    
      </div>

      <div class="col-lg-6 mt-4">
        <h2>Login Attempts</h2>
        <div class="card m-3 p-3">
          <table class="table table-bordered table-striped mt-4">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Login Count</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($login_attempts as $index => $attempt): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= htmlspecialchars($attempt['username']) ?></td>
                  <td><?= htmlspecialchars($attempt['login_count']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>    
      </div>
        <div class="row">
          <div class="col-lg-6 mt-2">
            <div class="card m-3 p-3 d-flex flex-row gap-3 justify-content-center text-center">
              <h5>User with Most Reminders:</h5>
              <p class="fw-bold fs-6 mb-0 p-0"><?= htmlspecialchars($most_reminders) ?></p>
            </div>
          </div>

            <div class="col-lg-6 mt-2 mb-4 d-flex justify-content-center">
              <div class="card m-2 p-2 text-center" style="width: 500px;">
                <h5 class="fs-4">Reminders by User</h5>
                <canvas id="reminderPieChart" width="250" height="200" style="max-width: 300px; height: fit-content; margin: auto"></canvas>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const reminderData = <?= json_encode($reminder_count) ?>;

  const labels = reminderData.map(entry => entry.user);
  const data = reminderData.map(entry => entry.reminder_count);

  const ctx = document.getElementById('reminderPieChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Reminders by User',
        data: data,
        backgroundColor: [
          '#007bff', '#dc3545', '#ffc107', '#28a745', '#6f42c1'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'right'
        }
      }
    }
  });
</script>

<style>

  h2{
      text-align: center;
  }

  .table th, td {
    text-align: center;
  }

  footer{
     bottom: auto !important;
  }
</style>

<?php require_once 'app/views/templates/footer.php' ?>  
