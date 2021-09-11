<?php
require_once "object.php";
if (isset($_POST['btnLogin'])){ 
  $err = [];
  if(isset($_POST['email']) && !empty($_POST['email'])){

    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      $user->set('email',$_POST['email']);
    } else{
      $err['email'] = 'Enter valid email';
    }
  } else{
    $err['email'] = 'Enter email';
  }
  if(isset($_POST['password']) && !empty($_POST['password'])){
    $user->set('password',$_POST['password']);
  } else{
    $err['password'] = 'Enter password';
  }
  if(count($err) == 0){
    $loginStatus = $user->login();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
​
<head>
  ​
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  ​
  <title>News Admin</title>
  ​
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  ​
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/custom.css">
  ​
</head>
​
<body class="bg-gradient-primary">
  ​
  <div class="container">
    ​
    <!-- Outer Row -->
    <div class="row justify-content-center">
      ​
      <div class="col-xl-10 col-lg-12 col-md-9">
        ​
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">news Admin-Welcome Back!</h1>
                  </div>
                  <?php if (isset($loginStatus)) { ?>
                  <div class="alert alert-danger">
                  Login failed!!</div>
                  <?php } ?>
                  <?php if (isset($_GET['msg']) && $_GET['msg'] == 1){ ?>
                  <div class="alert alert-danger">please login to access your dashboard</div>
                  <?php } ?>  

                  <form class="user" id="loginform" action="
                  <?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                    <?php if (isset($err['email'])) { ?>
                    <label id="exampleInputEmail-error" class="error" for="exampleInputEmail">
                      <?php echo $err['email'] ?></label>
                      <?php } ?> 


                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                      <?php if (isset($err['password'])) { ?>
                      <label id="exampleInputPassword-error" class="error" for="exampleInputPassword">
                        <?php echo $err['password'] ?></label>
                        <?php } ?> 

                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block" name="btnLogin">
                        Login
                      </button>
                      <hr>
                    </form>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ​
        </div>
        ​
      </div>
      ​
    </div>
    ​
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    ​
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    ​
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      //$('#loginform').validate();
      $("#loginform").validate({
        rules: {
    // simple rule, converted to {required:true}
    password: "required",
    // compound rule
    email: {
      required: true,
      email: true
    }
  }
});
  });
</script>
</body>
​</html>