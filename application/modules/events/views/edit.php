<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<?php if ( validation_errors() != ''): ?>
	<div class="bg-danger">
		<?php validation_errors(); ?>
	</div>
<?php endif;?>


<form class='form' role='form' action="<?php echo base_url ('users/home/editevent/'.$id); ?>" method="post">
  <div class="form-group">
    <label for="title" >Name or Title for the event:</label>
    <input type="text" name="title" id="title" class="form-control" maxlength="128" autocomplete="off" value="<?php echo $old['name']; ?>" />
  </div>

  <div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" name="description" id="description" style="resize: none;" class="col-xs-4" ><?php echo $old['description']; ?></textarea>
  </div>

  <div class="form-group">
  	<label for="location">Location: </label>
    <input type="text" name="location" id="location" class="form-control" maxlength="128" autocomplete="off" value="<?php echo $old['loc']; ?>" />
  </div>
  
  <div class="form-group">
    <input type="submit" class="btn btn-info" value="Update" />
  </div>
</form>

<a href="<?php echo base_url('users/home/delete/').$id;?>">
  <div class="btn btn-danger">
      Delete
  </div>
</a>
