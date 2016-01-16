<?php
   $attributes = array('class' => 'login-form');
   echo form_open('', $attributes);
?>
   <fieldset class="form-group">
      <label for="identity"><?php echo $identity_label; ?>:</label>
      <input type="text" class="form-control form-control-sm" id="identity" name="identity" value="<?php echo set_value('identity'); ?>" />
      <?php echo form_error('identity'); ?>
   </fieldset>
   <fieldset class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control form-control-sm" id="password" name="password" />
      <?php echo form_error('password'); ?>
   </fieldset>
   <div class="checkbox">
      <label>
         <input type="checkbox" name="remember" value="1"> Remember me
      </label>
   </div>
   <div class="error">
      <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
   </div>
   <div>
      <p class="pull-right">
         <small><em><a href="account/lost-password">Lost password?</a></em></small>
      </p>
   </div>
   <button type="submit" class="btn btn-primary btn-sm">Login</button>
<?php echo
   form_close();
?>
