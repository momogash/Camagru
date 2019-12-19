<?php
require_once './core/init.php';

$user = new User();

if(!$user->isLoggedIn())
{
    Redirect::to('index.php');
}
else{



if(Input::exists())
{
  $file = $_FILES['file'];

  var_dump($file);
  die();

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name']; //temporary location of file on computer before upload.
    $fileError = $_FILES['file']['error'];
    $filesize = $_FILES['file']['size'];
    //getting the file extension of image
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed))
    {
      if($fileError === 0)
      {
        if($filesize < 1000000)
        {
          $fileNameNew = uniqid('', true).".".$fileActualExt ; //gives a name of time format in current micro seconds
          $fileDestination = './uploads/'.$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
          //header("Location: gallery.php?uploadsuccess");
          DB::getInstance()->insert('images', array(
            'image_name' => $fileNameNew,
             'user_id' =>  Session::get('user'),
            'image' => $fileDestination
          ));
        }
        else{
          // Session::flash('home', 'File too big!');
          // Redirect::to('gallery.php');
          echo 'File too big!';
        }

      }
      else{
        // Session::flash('home', 'There was an error uploading the image!');
        // Redirect::to('gallery.php');
        echo 'There was an error uploading the image';
      }
      }
      else{
        //Session::flash('gallery', 'You cannot upload files of this type');
        // Redirect::to('gallery.php');
        
          echo 'You cannot upload files of this type';
    }

}
Redirect::to('gallery.php');
}