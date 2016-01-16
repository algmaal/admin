<?php
   $attributes = array('class' => 'login-form');
   echo form_open('', $attributes);
?>
   <fieldset class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control form-control-sm" id="username" name="username" value="<?php echo $edit_admin_values['username']; ?>" />
      <?php echo form_error('username'); ?>
   </fieldset>
   <fieldset class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?php echo $edit_admin_values['email']; ?>" />
      <?php echo form_error('email'); ?>
   </fieldset>
   <fieldset class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control form-control-sm" id="password" name="password" />
      <?php echo form_error('password'); ?>
   </fieldset>
   <fieldset class="form-group">
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password" />
      <?php echo form_error('confirm_password'); ?>
   </fieldset>
   <fieldset class="form-group form-inline">
      <label for="group">User group:</label>
      <select class="form-control form-control-sm" id="group" name="group">
         <option value="1" <?php if ($edit_admin_values2['name'] == 'admin'): echo 'selected'; endif; ?>>Admin</a>
         <option value="2" <?php if ($edit_admin_values2['name'] == 'member'): echo 'selected'; endif; ?>>Member</a>
      </select>
   </fieldset>
   <button type="submit" class="btn btn-primary btn-sm"><?php if (empty($edit_admin_values['username'])): echo 'Add user'; else: echo 'Edit user'; endif; ?></button>
<?php form_close(); ?>
<div class="error">
   <div class="error">
      <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
   </div>
</div>
