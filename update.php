<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');
}

if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,  
                'max' => 50
            )
            ));

            if($validation->passed())
            {
                //update
                try
                {
                    $user->update(array(
                        'name'=> Input::get('name')
                    ));
                    Session::flash('home', 'Your details have benn updated');
                    Redirect::to('index.php');

                }
                catch(Exception  $e)
                {
                    die($e->getMessage());
                }
            }
            else
            {
                foreach($validation->errors() as $error)
                {
                    echo $error, '<br>';
                }
            }
    }
}
?>

 <?php include_once './header.php'; ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" type="text/css" href="./CSS/signup.css">
     <title>Update</title>
 </head>
 <body>
     <form action="" method="post">
    <div class="container">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
        <br/>
        <label for="name">Email</label>
        <input type="text" name="email" value="<?php echo escape($user->data()->email); ?>">
        <br/>
        <label for="name">password</label>
        <input type="text" name="password" value="<?php echo escape($user->data()->password); ?>">
        <br/>
        <input type="submit" value="update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </div>
</form>
     
 </body>
 </html>

<?php include_once './footer.php'; ?>