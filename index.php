<?php
require_once './core/init.php';
require_once './header.php';
require_once './footer.php'; 

if(Session::exists('home'))
{
    echo '<p>' . Session::flash('home') . '<p>';
}

$user = new User();
if($user->isLoggedIn())
{
    ?>
    <p> Hello <a href="#"><?php echo escape($user->data()->name);?></a>!</p>
    <ul>
        <li><a href="logout.php">Log out</a></li>
        <li><a href="update.php">Update Details</a></li>
    </ul>
    <?php
}
else
{
    echo '<p> You need to <a href="login.php">log in</a> or <a href="register.php">register</p>';
}

/*$user = DB::getInstance()->query("SELECT username FROM user WHERE username = ?", array('alex'));
object to connect to db only once using getInstance, and get method to query our database for values.
Process: (a) first call getinstance to create a connection to DB and make an object instance($user)
(b) then use get function to query the desired database, which intern calls action to now check in database for desired values
$user = DB::getInstance()->get('users', array('username', '=', 'moloko77')); 

if(!$user->count())
{
    if count < 0 from the query that was done, then no user message is displayed. else ok
    echo 'No user';
}
if count is more than 0, mean we did find something in our database, then return the results.
else{
    echo $user->first()->username;
}

object to connect to db only once using getInstance, and inset method to insert  values into our database. 
$user = DB::getInstance()->insert('users', array(
    'username'=> 'Moloko7',
    'email' => 'moloko7@mailinator.com',
    'password' => 'Pass@123',
    'salt' => 'salt',
    'name' => 'Moloko',
    'joined' => date('Y-m-d H:i:s'),
    'group' => 1
));

//function to delete data from our database
$user = DB::getInstance()->update('users', 10, array(
    'password' => 'newpassword',
    'name' => 'Ebenezer'
    
));*/


