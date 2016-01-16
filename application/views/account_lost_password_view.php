<p>Please enter your <?php echo strtolower($identity_label); ?> to reset your password.</p>
<?php
   $attributes = array('class' => 'login-form');
   echo form_open('', $attributes);
?>
   <fieldset class="form-group">
      <label for="identity"><?php echo $identity_label; ?>:</label>
      <input type="text" class="form-control form-control-sm" id="identity" name="identity" />
      <?php echo form_error('identity'); ?>
   </fieldset>
   <div class="error">
      <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
   </div>
   <button type="submit" class="btn btn-primary btn-sm">Reset</button>
<?php
   form_close();
?>
