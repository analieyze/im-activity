

<!-- Modal -->
<div class="modal fade" id="addParticipant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Participant</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form action="backend/participant_code.php" method="post">
   
        <div class="row g-3">
  <div class="col-12">
    <input type="text" class="form-control" placeholder="First name" aria-label="First name" name = "first_name">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name = "last_name">
  </div>

    <div class="col-12">
    <input type="text" class="form-control" placeholder="Email" aria-label="Email" name = "email">
  </div>

  <div class="col-md-12">
    <select id="inputState" class="form-select" name = "gender">
      <option selected>Female</option>
      <option>Male</option>
    </select>
  </div>


    <div class="col-12">
    <input type="date" class="form-control" placeholder="Birthdate" aria-label="Birthdate" name = "birthdate">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="City" aria-label="City" name = "city">
  </div>

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name = "add_participant">Save changes</button>
      </div>
       </form>

    </div>
  </div>
</div>

