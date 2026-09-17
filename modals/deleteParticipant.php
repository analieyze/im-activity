<!-- Modal -->
<div class="modal fade" id="deleteParticipant<?php echo $participant->participant_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="backend/participant_code.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Participant</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Hidden input is required to pass the ID to your backend -->
          <input type="hidden" name="participant_id" value="<?php echo $participant->participant_id; ?>">
          
          <p>Are you sure you want to delete <strong><?php echo $participant->first_name . ' ' . $participant->last_name; ?></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" name="delete_participant">Delete Participant</button>
        </div>
      </div>
    </form>
  </div>
</div>