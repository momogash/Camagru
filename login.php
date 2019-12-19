<?php
require_once 'core/init.php';

if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed())
        {
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));
            if($login)
            {
                Redirect::to('index.php');

            }
            else
            { 
                echo 'Login failed';
            }
            
        }
        else
        {
            foreach($validation->errors() as $error)
            {
                echo $error, '</br>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <?php include_once './header.php'; ?>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="./CSS/loginform.css" />
<link rel="stylesheet" type="text/css" href="./CSS/header.css">
<link rel="stylesheet" type="text/css" href="./CSS/footer.css">
</head>
<body>
<div class="container">
    <section id="content">
        <form action="#" method="post">
            <h1>Login Form</h1>
            <div>
                <input type="text" placeholder="Username" name="username" id="username" />
            </div>
            <div>
                <input type="password" placeholder="Password" name="password" id="password" />
            </div>
            <div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" /> 
                <input type="submit" name="login-submit" value="Log in" />
                <a href="./">Lost your password?</a>
                <a href="./register.php">Register</a>forgot
            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->
<?php include_once './footer.php'; ?>
</body>
</html>
