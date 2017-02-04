<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<h3>Create new event</h3>
<?php if(isset($errors) && $errors): ?>
    <div class="alert alert-danger">
        <?php echo $errors; ?>
    </div>
<?php endif; ?>

<?php echo form_open (base_url ('events/create'), array('class' => 'form', 'role' => 'form')); ?>
  <div class="form-group">
    <label for="title">Name or Title for the event:</label>
    <input type="text" name="title" id="title" class="form-control" maxlength="128">
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" name="description" id="description" style="resize: none;" class="col-xs-4"></textarea>
  </div>
  <div class="form-group">
    <label for="Date">Date(YYYY-MM-DD):</label>
    <input type="date" name="date" class="form-control" id="date" />
  </div>
  <div class="form-group">
    <label data-toggle="collapse" data-target="#repeat">
      <span class="input-group-addon">
        <input type="radio" name="type" value="onetime" checked />
        <span> One day event </span>
      </span>
    </label>
    &nbsp;
    <label data-toggle="collapse" data-target="#repeat">
      <span class="input-group-addon">
          <input type="radio" name="type" value="repeating" />
          <span> Repeating event </span>
      </span>
      
    </label>
    <div id="repeat" class="collapse form-group">
      <ul class="list-group">
        <li class="list-group-item">
          <input type="radio" name="repeat"  class="input-control" />
          <span> Daily </span>
        </li>

        <li class="list-group-item">
          <input type="radio" name="repeat"  class="input-control" />
          <span> Weekly </span>
        </li>

        <li class="list-group-item">
          <input type="radio" name="repeat"  class="input-control" />
          <span> Monthly </span>
        </li>

        <li class="list-group-item">
          <input type="radio" name="repeat"  class="input-control" />
          <span> Yearly </span>
        </li>
      </ul>    </div>
    
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-info" value="Create" />
  </div>
</form>

