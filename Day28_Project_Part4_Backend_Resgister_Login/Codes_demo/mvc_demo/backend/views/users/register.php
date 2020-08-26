<?php
//views/users/register.php
?>
<h1>Form đăng ký user</h1>
<form action="" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"
           class="form-control" />
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password"
    class="form-control" />
  </div>
  <div class="form-group">
    <label for="confirm_password">Nhập lại password</label>
    <input type="password" id="confirm_password"
           name="confirm_password" class="form-control" />
  </div>
  <div class="form-group">
    <input type="submit" name="register" value="Register"
         class="btn btn-primary"  />
  </div>
</form>
