<p><a href="users/add"><i class="fa fa-plus"></i> Add new user</a></p>
<div class="table-responsive">
   <table class="table table-bordered table-striped table-sm">
      <tr>
         <th>ID</th>
         <th>Username</th>
         <th>Email</th>
         <th>Created on</th>
         <th>Last login</th>
         <th>Group</th>
         <th>Status</th>
         <th>Actions</th>
      </tr>
      <?php
         foreach ($users as $user):
            $created_on = unix_to_human($user['created_on']);

            if ($user['last_login'] == 0):
               $last_login = '-';
            else:
               $last_login = unix_to_human($user['last_login']);
            endif;

            if (($user['active']) == 1):
               $active_link = 'users/deactivate/' . $user['id'];
               $active_text = 'active';
            else:
               $active_link = 'users/activate/' . $user['id'];
               $active_text = 'not active';
            endif;

            echo "<tr>
                     <td>{$user['id']}</td>
                     <td>{$user['username']}</td>
                     <td>{$user['email']}</td>
                     <td>{$created_on}</td>
                     <td>{$last_login}</td>
                     <td>{$user['group_name']}</td>
                     <td><a href='{$active_link}'>{$active_text}</a></td>
                     <td><a href='users/edit/{$user['id']}'>Edit</a> | <a class='confirm' href='users/delete/{$user['id']}'>Delete</a></td>
                  </tr>";
         endforeach;
      ?>
   </table>
   <div class="error">
      <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
   </div>
</div>
