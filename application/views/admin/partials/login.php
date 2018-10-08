<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

      <?php require('css.php'); ?>

</head>

<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            <h3>Welcome to Admin</h3>

            <p>Login in. To see it in action.</p>
       
          <?php  $this->load->view('partials/messages');?>
                            
            <form class="m-t" role="form" method="post" action="login">
                
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <button type="submit" name="btn_login" class="btn btn-primary block full-width m-b">Login</button>

            </form>

        </div>
    </div>
 
  <?php require('js.php'); ?>

</body>
</html>