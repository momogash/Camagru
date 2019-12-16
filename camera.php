<?php
require './header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camera</title>
    <link rel="stylesheet" type="text/css" href="./CSS/camera.css">
    <link rel="stylesheet" type="text/css" href="./CSS/header.css">
    
</head>
<body>
    <div class="navbar">
       
    </div>
   
    <div class="top-container">
       <!-- <form method="post" action="cam_processer.php">  </form>-->
        <video id="video" autoplay>video not available</video>
        <br>
        <div class="stickers">
       <button id="sticker_1"><img src="./stickers/bandena.png" id="bandena" style="height: 80px; width: 80px;"></button>
       <button id="sticker_2"><img src="./stickers/bunnyears.png" id="bunnyears" style="height: 80px; width: 80px;"></button>
       <button id="sticker_3"><img src="./stickers/glasses.png" id="glasses" style="height: 80px; width: 80px;"></button>
       <button id="sticker_4"><img src="./stickers/gradframe.png" id="gradframe" style="height: 80px; width: 80px;"></button>
       </div>
       <br>
    
       <button id="photo-button" class="btn btn-dark" >Take Photo</button>
    
      <select id="photo-filter" class="select">
            <option value="none">Normal</option>
            <option value="grayscale(100%)">Grayscale</option>
            <option value="sepia(100%)">Sepia</option>
            <option value="invert(75%)">Invert</option>
            <option value="hue-rotate(90deg)">Hue</option>
            <option value="blur(5px)">Blur</option>
            <option value="contrast(200%)">Contrast</option>
        </select>
        <canvas id="canvas"></canvas>
        <canvas id="overlay" width="75" height="75" style="position:absolute"></canvas>
     
        <button id="clear-button" class="btn btn-light">Clear</button>
        <form action="img_process.php" method="POST" >
            <input type="hidden" id="hidden_data" name="hidden_id">
            <input type="submit" class="btn btn-dark" id="image_saver" name="image_saver" value="Save"> 
        </form>
        
        
    </div>

    <div class="btom-container">
        <div id="photos"></div>
    </div>
     
    <script type="text/javascript" src="./js/camera.js"></script>
</body>
</html>