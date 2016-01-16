<p>Please enter your new password and confirm it.</p>
<?php
   $attributes = array('class' => 'login-form');
   echo form_open('', $attributes);
?>
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
   <div class="error">
      <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
   </div>
   <button type="submit" class="btn btn-primary btn-sm">Reset</button>
<?php
   form_close();
?>
