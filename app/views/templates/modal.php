<!--- Modal --->
<div class="modal fade" id="addReminderModal" tabindex="-1" aria-labelledby="addReminderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addReminderModalLabel">Please Add Details!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/reminders/create" method="POST">
          <div class="mb-3">
            <label for="reminder-title" class="form-label">Title</label>
            <input type="text" class="form-control" id="reminder-title" name="reminder-title" required>
            <label for="reminder-due" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="reminder-due" name="reminder-due" required>
          </div>
          <button type="submit" class="btn btn-dark">Done</button>
        </form>
      </div>
    </div>
  </div> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>