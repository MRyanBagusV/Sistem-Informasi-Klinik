<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link href="assets/img/logo.jpg" rel="shortcut icon" />
    <title>Klinik Atlantic</title>
</head>
<body>
<div class="logo"></div>
<div class="login_box">
    <p class="login_text">Silahkan login</p>
    <form action="actions/login.php" method="post">        
        <label>Username</label>
        <input type="text" name="username" class="login_form" placeholder="Username" required>        

        <label>Password</label>
        <input type="password" name="password" class="login_form" placeholder="Password" required>

        <input type="submit" class="login_switch" name="login" value="Log In">
    </form>
</div>
</body>
</html>
