<?php
require_once 'core/init.php';

$connect = DB::getInstance();

if (isset($_POST['comment']))
{
    $connect->insert('comments', array(
        'picture_id' => Input::get('img_id'),
        'commentor_id' => Session::get('user'),
        'comment' => Input::get('right')
    ));
}

Redirect::to('gallery.php');

?>