<?php
require_once 'core/init.php';

$connect = DB::getInstance();
$imageId = Input::get('img_id');


if (isset($_POST['comment']))
{
    $connect->insert('comments', array(
        'image_id' => Input::get('img_id'),
        'commentor_id' => Session::get('user'),
        'comment' => Input::get('right')
    ));
}

Redirect::to('gallery.php');

?>