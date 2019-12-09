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
     if(Input::get('txt_image_name'))
    {
       // echo 'reached here';
         $object = new Images();

         // print_r($object);
         //$val = $object->insert_image();
         //print_r($val);

        // // }
        // //  else
        // // {
        //     foreach($object->errors() as $error)
        //     {
        //         echo $error, '</br>';
        //     }
        // // }
        


        
  }
 }
}