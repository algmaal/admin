<p>Please enter your current password and your new email address.</p>
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
      <label for="email">Email:</label>
      <input type="text" class="form-control form-control-sm" id="email" name="email" />
      <?php echo form_error('email'); ?>
   </fieldset>
   <div class="error">
      <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
   </div>
   <button type="submit" class="btn btn-primary btn-sm">Change</button>
<?php
   form_close();
?>
