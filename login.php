<?php
require_once 'core/init.php';

if (isset($_GET['user']))
{
    $user = new User();
    $status = $user->find(Input::get('user'));
    
    if ($status)
    {
        $mail_salt = Input::get('salt');
        $db_salt = $user->data()->salt;
        $id = $user->data()->id;
        if ($db_salt == $mail_salt)
        {
            $user->update(['confirmed' => 1], $id);
        }
    }
}

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
            $login = $user->login(escape(Input::get('username')), escape(Input::get('password')));
            //var_dump($login);
            // die();
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
                <input type="text" placeholder="Username" name="username" id="username" />
                <input type="password" placeholder="Password" name="password" id="password" />
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
