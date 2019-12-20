<?php
require_once './core/init.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php require './header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    <link rel="stylesheet" type="text/css" href="./css/camera.css">
    <link rel="stylesheet" type="text/css" href="./CSS/header.css">
    <link rel="stylesheet" type="text/css" href="./CSS/gallery.css">
    
</head>
<body>
    <center><h2>Save Photos To Gallery</h2></center>
<center>
    <div>
        <form action="./upload.php" method="post" enctype="multipart/form-data">
        <table border="1" width="80%">
        <tr>
            <th width="50%">Upload Image</th>
            <td width="50%"><input type="file" name="file"></td>
        </tr>
        <tr>
            <td>
                <button type="submit" name="submit">UPLOAD</button>
            </td>
        </tr>
        </table>
        </form>
    </div>
</center>
<div class="comments">
<?php
$comment_counter = 0;
$gallery = 
$count = count($gallery->getComments($gallery->paginatedPicId($image)));
try
{
    while($comment_count > $comment_cntr)
    {
        $comments_objByImg = $gallery->getComments($gallery->paginatedPicId($image))[$comment_cntr]->comment;
        echo $comments_objByImg . "<br>";
        $comment_cntr = $comment_cntr + 1;
    }
}
catch (Exception $er)
{
    echo $er;
}
?>
</div>
<?php
$row = DB::getInstance()->get('images', array('image_id', '>', '0'));
$arr = $row->results();

$rows = $row->count();
$current_page = 1;
$per_page = 5;
$total_pages = ceil($rows/$per_page);
if (isset($_GET['page']) && !empty($_GET['page']))
{
    $page = $_GET['page'];
    if ($page > $total_pages || $page <= 0)
    {
        Redirect::to('gallery.php?page=1');
    }
} else
{
    $page = 1;
}

$array1 = [];    
foreach ($arr as $obj) {
    $array1[] = $obj->image_name;
}
$array = [];
while (--$rows >= 0)
{
    $array[] = $array1[$rows];
}


$to_display = $page * $per_page;
$i = $page * $per_page - $per_page;
while (isset($array[$i]) && $i < $to_display)
{
    echo '<div class="btom-container">
        <figure class="#photos">
            <img src="uploads/'.$array[$i++].'" class="gallery__img">
        </div>';
}

for ($j = 1; $j <= $total_pages; $j++)
{
    if ($j == $page)    echo '<a class="active">' .$j.'</a>';
    else echo '<a href="gallery.php?page='.$j.'">' .$j.'</a>';
}

?>
</body>
</html>