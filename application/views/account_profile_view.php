<p>
   <strong>Username:</strong> <?php echo $username; ?><br>
   <strong>Email:</strong> <?php echo $email; ?><br>
   <strong>Group:</strong> <?php echo $group; ?><br>
   <strong>Joined:</strong> <?php echo $joined; ?>
</p>
<p><a href="account/change-email">Change Email</a> | <a href="account/change-password">Change Password</a></p>
<div class="error">
   <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
</div>
