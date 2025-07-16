<?php
$reminders = $reminders ?? [];
?>
<?php require_once 'app/views/templates/header.php' ?>
<?php include 'app/views/templates/modal.php'?>
<div class="container my-4">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                  <h2>My reminders</h2>
                  <button type="button" class="btn btn-dark" style="" data-bs-toggle="modal" data-bs-target="#addReminderModal">
                    Add Reminder</button>
                </div>  
              <table class="table table-bordered table-striped mt-4">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Deadline</th>
                    <th>Complete</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($reminders as $index => $reminder): ?>
                    <tr>
                      <td><?= $index + 1 ?></td>
                      <td><?= htmlspecialchars($reminder['title']) ?></td>
                        <td><?= htmlspecialchars($reminder['deadline']) ?></td>
                        <td>
                        <form action="/reminders/complete" method="POST" class="d-inline">
                          <input type="hidden" name="id" value="<?= $reminder['uid'] ?>">
                          <input type="checkbox" name="completed" value="1" onchange="this.form.submit()" <?= $reminder['completed'] ? 'checked' : '' ?>>
                        </form>
                      </td>
                      <td>
                        <form action="/reminders/delete" method="POST" style="display:inline;">
                          <input type="hidden" name="id" value="<?= $reminder['uid'] ?>">
                          <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>

  

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <style>
    .table th, td{
      text-align: center;
    }
  </style>

<?php require_once 'app/views/templates/footer.php' ?>