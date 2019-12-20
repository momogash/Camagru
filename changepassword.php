<?php
require_once './core/init.php';
if(!$user = new User())
{
    Redirect::to('index.php');
}
if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
       
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
             'password_current' => array(
                 'required' => true,
                 'min' => 6
                ),
             'password_new' => array(
                 'required' => true,
                 'min' => 6
             ),
             'password_new_again' => array(
                 'required' => true,
                 'min' => 6,
                 'matches' => 'password_new'
                  )
         ));


        if($validation->passed())
         {
             //after validating user, check if current password is equall to password in database
             if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password)
             {
                 Session::flash('home', 'Password is incorrect');
                Redirect::to('index.php');

             }
            else
            { 
                $salt = Hash::salt(32);
                $user->update(array(
                    'password' => Hash::make(Input::get('password_new'), $salt),
                    'salt' => $salt
                ));
                $email = Input::get('email');
                $username = Input::get('username');
                $subject = 'Password changed!';
                $message = 'Hello." ".{$username}';
                $message .= "\r\n";
                $message .= 'Your password has been successfully changed, Please select "Log In" to access your account.';
                $message .= "\r\n";
                $message .= "<a href='http://localhost:8080/camagru/login.php?user=$username&salt=$salt'>Log In</a>";
                $headers = 'From:noreply@camagru.com' . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8". "\r\n";
                mail($email, $subject, $message, $headers); 
                
                Session::flash('home', 'Your password has been changed');
                Redirect::to('index.php');
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/signup.css">
    <title>Change</title>
</head>
<body>

<form action="" method="post">
    <div class="container">
        <label for="password_current">Current password</label>
        <input type="password" name="password_current" id="password_current" value="<?php echo escape($user->data()->name); ?>">
        <br/>
        <label for="password_new">New password</label>
        <input type="password" name="password_new" id="password_new" value="<?php echo escape($user->data()->name); ?>">
        <br/>
        <label for="password_new_again">New password again</label>
        <input type="password" name="password_new_again" id="password_new_again" value="<?php echo escape($user->data()->name); ?>">
        <input type="submit" value="change">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </div>
</form>
<?php include_once './footer.php'; ?>    
</body>
</html>

