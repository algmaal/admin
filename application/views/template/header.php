<!DOCTYPE html>
<html lang="sr">
<head>
   <title><?php echo $page_title; ?> - Admin Panel</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <base href="<?php echo base_url(); ?>" />
   <link rel="icon" type="image/png" href="assets/img/admin.png">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
   <div class="container">
      <div class="row">
         <nav class="navbar navbar-dark bg-primary">
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">&#9776;</button>
            <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
               <a class="navbar-brand"><img src="assets/img/admin.png" width="32" alt="Admin Panel" /></a>
               <ul class="nav navbar-nav">

                  <!-- Menu items -->
                  <li class="nav-item <?php if ($menu_item == 'Home'): echo "active"; endif; ?>">
                     <a class="nav-link" href="home"><i class="fa fa-home"></i> Home</a>
                  </li>
                  <li class="nav-item <?php if ($menu_item == 'Users'): echo "active"; endif; ?>">
                     <a class="nav-link" href="users"><i class="fa fa-list"></i> Users</a>
                  </li>
                  <li class="nav-item <?php if ($menu_item == 'Contact'): echo "active"; endif; ?>">
                     <a class="nav-link" href="contact"><i class="fa fa-envelope"></i> Contact</a>
                  </li>
                  <li class="nav-item dropdown pull-xs-right <?php if ($menu_item == 'Account'): echo "active"; endif; ?>">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-lock"></i> Account</a>
                        <div class="dropdown-menu" aria-labelledby="Preview">
                           <?php if (!$this->ion_auth->logged_in()): ?>
                           <a class="dropdown-item" href="account/login"><i class="fa fa-sign-in"></i> Login</a>
                           <?php else: ?>
                           <a class="dropdown-item" href="account/profile"><i class="fa fa-user"></i> Profile</a>
                           <a class="dropdown-item" href="account/logout"><i class="fa fa-sign-out"></i> Logout</a>
                           <?php endif; ?>
                        </div>
                  </li>
                  <!-- Menu items ends -->

               </ul>
            </div>
         </nav>
      </div>
      <div class="row row-margin">
         <div class="card">
            <div class="card-header" id="card-heading">
               <?php echo $page_title; ?>
            </div>
            <div class="card-block">
