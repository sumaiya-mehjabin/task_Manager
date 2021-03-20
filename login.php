<?php include './system/loginCheck.php'?>
<?php include 'globals/header.php'?>
<?php include './system/auth/login.php'?>
<body>
<div class="auth-body-wrapper">
    <div class="container">
        <div class="offset-3 col-md-6">
            <div class="form-container">
                <div class="form-title">LOGIN TO SYSTEM</div>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" value="<?php echo $email ?>" class="form-control <?php if ($error['email'] != '') echo 'is-invalid'; ?>" placeholder="Email Address" name="email" required>
                        <div class="invalid-feedback"><?php if ($error['email'] != '') echo $error['email']; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" value="<?php echo $password ?>" class="form-control <?php if ($error['password'] != '') echo 'is-invalid'; ?>" placeholder="Password" name="password" required>
                        <div class="invalid-feedback"><?php if ($error['password'] != '') echo $error['password']; ?></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary w-100">LOGIN</button>
                    </div>
                    <div class="form-group">
                        <a href="./register.php">New here? Register Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
