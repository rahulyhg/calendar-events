<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<h3>Create new event</h3>
<?php if(isset($errors) && !$errors): ?>
    <div class="alert alert danger">
        <?php echo $errors; ?>
    </div>
<?php endif; ?>

 <form class="form" role="form" method="post" action="<?php echo base_url('events/newone'); ?>">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" maxlength="128" id="name" class="col-xs-4">
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" id="description" style="resize: none;" class="col-xs-4"></textarea>
  </div>
  <div class="form-group">
    <label for="Date">Date(YYYY-MM-DD):</label>
    <input type="date"  class="form-control" id="date"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-info" value="Create" />
  </div>
</form>

