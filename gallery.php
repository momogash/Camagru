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
<?php
 $row = DB::getInstance()->get('images', array('image_id', '>', '0'));
 $arr = $row->results();
 print_r($arr);
 $array = [];
 
 foreach ($arr as $obj) {

    $array[] = $obj->image_name;
 }


for ($i = 0; $i < count($array); $i++){

    echo '<div class="btom-container">
            <figure class="#photos">
             <img src="uploads/'.$array[$i].'" class="gallery__img">
         </div>';
       
}
?>
</body>
</html>