<?php include './system/loginCheck.php'?>
<?php include 'globals/header.php'?>
<?php include './system/auth/register.php'?>
<body>
<div class="auth-body-wrapper">
    <div class="container">
        <div class="offset-3 col-md-6">
            <div class="form-container">
                <div class="form-title">CREATE NEW ACCOUNT</div>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="name" value="<?php echo $name ?>" class="form-control <?php if ($error['name'] != '') echo 'is-invalid'; ?>" placeholder="Name" name="name">
                        <div class="invalid-feedback"><?php if ($error['name'] != '') echo $error['name']; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" value="<?php echo $phone ?>" class="form-control <?php if ($error['phone'] != '') echo 'is-invalid'; ?>" placeholder="Phone Number" name="phone">
                        <div class="invalid-feedback"><?php if ($error['phone'] != '') echo $error['phone']; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" value="<?php echo $email ?>" class="form-control <?php if ($error['email'] != '') echo 'is-invalid'; ?>" placeholder="Email Address" name="email">
                        <div class="invalid-feedback"><?php if ($error['email'] != '') echo $error['email']; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" value="<?php echo $password ?>" class="form-control <?php if ($error['password'] != '') echo 'is-invalid'; ?>" placeholder="Password" name="password">
                        <div class="invalid-feedback"><?php if ($error['password'] != '') echo $error['password']; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" value="<?php echo $confirm_password ?>" class="form-control <?php if ($error['confirm_password'] != '') echo 'is-invalid'; ?>" placeholder="Password" name="confirm_password">
                        <div class="invalid-feedback"><?php if ($error['confirm_password'] != '') echo $error['confirm_password']; ?></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary w-100">Register</button>
                    </div>
                    <div class="form-group">
                        <a href="./login.php">Already have an account? Login Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
