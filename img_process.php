<?php
require_once './core/init.php';

$user = new User();
var_dump($_POST);

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');
}
else{

if(Input::exists())
{
    $img = $_POST['hidden_id']; 
    //var_dump($_POST);
    //die();
    $imgName = uniqid('', true).".png"; //gives a name of time format in current micro seconds
    $fileDestination = './uploads/'.$imgName;//$imgPath = "../uploads/gallery/".$baseImgName; //path to server folder
	$imgUrl = str_replace("data:image/png;base64,", "", $img);
	$imgUrl = str_replace(" ", "+", $imgUrl);
    $imgDecoded = base64_decode($imgUrl);
    file_put_contents($fileDestination, $imgDecoded);

 //  $sticker = $_POST['sticker'];
  // var_dump($sticker);
  // die();

    DB::getInstance()->insert('images', array(
            'image_name' => $imgName,
            'image' => $fileDestination
    ));
    //var_dump($img);

}
}
?>