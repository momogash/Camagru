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
    
</head>
<body>
    <center><h2>Save Photos To Gallery</h2></center>
<CENTER>
    <div>
        <form action="./upload.php" method="post" enctype="multipart/form-data">
        <table border="1" width="80%">
        <tr>
            <th width="50%">Image Name</th>
            <td width="50%"><input type="text" name="txt_image_name"></td>
        </tr>
        <tr>
            <th width="50%">Upload Image</th>
            <td width="50%"><input type="file" name="txt_image"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="Submit" value="Save">
            </td>
        </tr>
        </table>
        </form>
    </div>
</CENTER>
</body>
</html>