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
    <link rel="stylesheet" type="text/css" href="./css/camera.css">
    <link rel="stylesheet" type="text/css" href="./CSS/header.css">
    
</head>
<body>
    <div class="navbar">
       
    </div>
    <div class="top-container">
        <video id="video" autoplay></video>
        <button id="photo-button" class="btn btn-dark">
            Take Photo
        </button>
        <select id="photo-filter" class="select">
            <option value="none">Normal</option>
            <option value="grayscale(100%)">Grayscale</option>
            <option value="sepia(100%)">Sepia</option>
            <option value="invert(75%)">Invert</option>
            <option value="hue-rotate(90deg)">Hue</option>
            <option value="blur(5px)">Blur</option>
            <option value="contrast(200%)">Contrast</option>
        </select>
        <button id="clear-button" class="btn btn-light">Clear</button>
        <input type="submit" name="Submit" value="Save" class="btn btn-dark">
        <canvas id="canvas"></canvas>
    </div>
    <div class="btom-container">
        <div id="photos"></div>
    </div>
    <script type="text/javascript" src="./js/camera.js"></script>
</body>
</html>