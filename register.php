<?php
    require_once 'core/init.php';
    if(Input::exists())
    {
        if(Token::check(Input::get('token')))
        {
            // create an instance object of the class validate
            $validate = new Validate();
            //access the method checkform using the object of the class.
            $validation = $validate->check($_POST, array(
                // contains all the rules for each field we need for validation
                //field name in database should match the 'name'tag on the form
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 8,
                    'unique' => 'users'
                ),
                'email' => array(
                    'required' => true,
                    'unique' => 'users',
                    'max' => 50,
                    'valid_email' => true
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6,
                ),
                'passwordConf' => array(
                    'required' => true,
                    'matches' => 'password',
                ),
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20
                )
            ));
            if($validation->passed())
            {
                //since the validation has passed, we now want to create the user with the information given.
                $user = new User();
                $salt = Hash::salt(32); 
                

                try{
                    $user->create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'name' => Input::get('name'),
                        'email' => Input::get('email'),
                        'joined' => date('Y-m-d H:i:s'),
                        'group' => 1
                    ));

                    Session::flash('home', 'you have been redirected to homepage');
                    Redirect::to('index.php');

                }
                catch(Exception $e){
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
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../CSS/header.css">
    <link rel="stylesheet" type="text/css" href="../CSS/footer.css">

</head>
<body>
    <h1> Register New User Here</h1>
    <div>
     <!--   <img src="../img/logo.png"><br><br> --->
    <form action="register.php" method="POST">
        <table><tr>
            <td>username:</td>
            <td><input type="text" name="username" <?php echo escape(Input::get('username')); ?> ></td><tr></tr>
            <td>Email:</td>
            <td><input type="email" name="email" id="email"></td><tr></tr>
            <td>Name:</td>
            <td><input type="text" name="name" id="name" <?php echo escape(Input::get('name')); ?> ></td><tr></tr>
            <td>Password:</td>
            <td><input type="password" name="password" ></td><tr></tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="passwordConf"></td><tr></tr>
            <td><input type="hidden" name="token" value="<?php echo Token::generate();?>" ></td><tr></tr>
            <td><input type="submit" name="submit" value="Register Now"></td>
        </tr>
        </table>
    </form>
<?php include_once './footer.php'; ?>
</body>
</html>