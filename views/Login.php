<?php
if ( isset( $_SESSION['user_id'] ) ) {
	header( 'Location: ' . BASEURL );
}

if ( isset( $_REQUEST['submit'] ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) && $_POST['username'] !== '' && $_POST['password'] !== '' ) {
        $user_name     = htmlEntities($_POST['username'], ENT_QUOTES);
		$user_password = htmlEntities($_POST['password'], ENT_QUOTES);
        $user = LoginController::getUser($user_name);
        if( $user != null ) {
            $user = $user[0];
            if ( password_verify( $user_password, $user['password'] ) ) {
				// Login successful.
				$_SESSION['user_id']              = $user['id'];
				$_SESSION['last_login_timestamp'] = time();
				header( 'Location: ' . BASEURL );
			} else {
				unset( $_SESSION['user_id'] );
			}
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

    <title>Đăng nhập</title>
</head>
<body>
    <main class="site-content wrapper" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="column column-50 column-offset-25">
                <form method="post" action="<?php echo BASEURL . 'login'; ?>">
                    <fieldset>
                        <div class="form-group">
                            <label for="username">Nhập tên đăng nhập hoặc email *</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu *</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        
                        <input class="button-primary" type="submit" name="submit" value="Đăng nhập">
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>