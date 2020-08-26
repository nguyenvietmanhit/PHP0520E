<?php
//views/users/login.php
?>
<h1>Form đăng nhập</h1>
<form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" name="login" value="Login"
               class="btn btn-success" />
        <a href="index.php?controller=user&action=register">
            Đăng ký tài khoản
        </a>
    </div>
</form>