<?php
require './header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Camera</title>
    <link rel="stylesheet" type="text/css" href="./CSS/camera.css" />
    <link rel="stylesheet" type="text/css" href="./CSS/header.css" />
  </head>
  <body>
    <div class="navbar"></div>

    <div class="top-container">
      <!-- <form method="post" action="cam_processer.php">  </form>-->
      <video id="video" height="500" width="500" autoplay>video not available</video>
      <div class="stickers">
              <img
                src="./stickers/bandena.png"
                id="bandena"
                style="height: 80px; width: 80px;"
                onclick="draw('bandena', 500, 300);"
              /> 

            <img
              src="./stickers/bunnyears.png"
              id="bunnyears"
              style="height: 80px; width: 80px;"
              onclick="draw('bunnyears', 200, 300);"
            />
            <img
              src="./stickers/glasses.png"
              id="glasses"
              style="height: 80px; width: 80px;"
              onclick="draw('glasses', 500, 300);"
            />
            <img
              src="./stickers/gradframe.png"
              id="gradframe"
              style="height: 80px; width: 80px;"
              onclick="draw('gradframe', 500, 300);"
            />
      </div>

      <button id="photo-button" class="btn btn-dark"onclick="snap();" >Take Photo</button>

     <!-- <select id="photo-filter" class="select">
        <option value="none">Normal</option>
        <option value="grayscale(100%)">Grayscale</option>
        <option value="sepia(100%)">Sepia</option>
        <option value="invert(75%)">Invert</option>
        <option value="hue-rotate(90deg)">Hue</option>
        <option value="blur(5px)">Blur</option>
        <option value="contrast(200%)">Contrast</option>
      </select> 
      <button id="clear-button" class="btn btn-light">Clear</button> -->
      <form action="img_process.php" method="POST">
        <input type="hidden" id="hidden_data" name="hidden_id" />
        <input type="submit" class="btn btn-dark" id="image_saver" name="image_saver" value="Save"/>
        <input type="hidden" id="sticker" name="addsticker" />
        
      </form>
    </div>
    <canvas id="canvas" height="500" width="500"d></canvas>

    <div class="btom-container">
      <div id="photos"></div>
    </div>

    <script type="text/javascript" src="./js/camera.js"></script>
  </body>
</html>
