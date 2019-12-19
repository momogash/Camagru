//  let width = 500,
//      height = 500,
//             filter = 'none',
//             streaming = false;

var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');

let constraintObj = {
    audio : false,
    video : true //{
       // facingMode: 'user',
        //width: { min: 640, ideal: 1280, max: 1920 },
        //height: { min: 480, ideal: 720, max: 1080 } 
   //}
};

//handle older browsers that might implement getUserMedia differently
if ( navigator.mediaDevices === undefined ) {
    navigator.mediaDevices = {};
    navigator.mediaDevices.getUserMedia = function( constraintObj ) {
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia 
        || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;
        if ( !getUserMedia ) {
            return Promise.reject( new Error( 'getUserMedia is not implemented in this browser' ) );
        }
        return new Promise( function( resolve, reject ) {
            getUserMedia.call( navigator, constraintObj, resolve, reject );
        } );
    }
} else {
    navigator.mediaDevices.enumerateDevices();
}

navigator.mediaDevices.getUserMedia( constraintObj ).then( function( mediaStreamObj ) {
 //connecting the meadia stream to the video element
 var video = document.querySelector( 'video' );
 if ( 'srcObject' in video ) {
     //newer versions
     video.srcObject = mediaStreamObj;
 } else {
     //old versions
     video.src = window.URL.createObjectURL( mediaStreamObj );
 }

//auto show in the video element what is being shown in the video stream
 video.onloadedmetadata = function ( ev ) {
     video.play();
 };
 
} ).catch( function( err ) {
    console.log( err.name, err.message );
} );


//funtion to draw an image on the canvas once picture is taken
function snap() {
    var but = document.getElementById( 'image_saver' );
    but.setAttribute( 'type', 'submit' );
    canvas.width = video.clientWidth;
    canvas.height = video.clientHeight;
    context.drawImage( video, 0, 0, canvas.width, canvas.height);
}

//function that enable a draws a sticker onto the canvas
function draw( x, dx, dy ) {
    var image = document.getElementById(x);
    context.drawImage(image, canvas.width - dx, canvas.height - dy, 70, 70);
}

//function creates the image
function finalImage() {
    var element = document.getElementById( 'picture' );
    var img = canvas.toDataURL( 'image/jpeg' );
    element.setAttribute('value', img);
}

/*                          Old Work                                        */ 


// //global variables
//         let width = 500,
//             height = 500,
//             filter = 'none',
//             streaming = false;

//          navigator.getUserMedia = (navigator.getUserMedia ||
//                             navigator.webkitGetUserMedia ||
//                             navigator.mozGetUserMedia || 
//                             navigator.msGetUserMedia);

//         //DOM elements
//         const video = document.getElementById('video');
//         const canvas = document.getElementById('canvas');
//         const stickerCanvas = document.getElementById('overlay');

//         const context = stickerCanvas.getContext('2d');
       
        

//         const photos = document.getElementById('photos'); //pics at the bottom
//         const photoButton = document.getElementById('photo-button'); //take picture button
//         const clearButton = document.getElementById('clear-button'); //clear button
//         const photoFilter = document.getElementById('photo-filter'); //filter button
         const saveButton = document.getElementById('image_saver'); //save button

//         const bandena = document.getElementById('b_button');
//         const bunnyears = document.getElementById('bunnyears');
//         const glasses = document.getElementById('glasses');
//         const gradframe = document.getElementById('gradframe');
//         const saveSticker = document.getElementById('save_stickers');


//         const constraints = {video: true, audio: false};

//         //get media stream
//         navigator.mediaDevices.getUserMedia(constraints)
//             .then(function(stream){
//                 //link video sauce form form
//                 video.srcObject = stream;
//                 //play vieo
//                 video.onloadmetadata = function(e) {
//                      video.play();

//                 }
               
//             })
//             .catch(function(err){
//                 console.log(`Error: ${err}`);
//             });

//             //paly when ready
//             video.addEventListener('canplay',function(e){
//                 if(!streaming){
//                     //set vieo / canvas height
//                     height = video.videoHeight / (video.videoWidth / width);
//                     video.setAttribute('width', width); //sets the html attribute
//                     video.setAttribute('height', height);
//                     canvas.setAttribute('width', width);
//                     canvas.setAttribute('height', height);

//                     streaming = true;
//                 }
//             }, false);
//             //photo button event
//             photoButton.addEventListener('click', function(e){
//                 takePicture();

//                 e.preventDefault();
//             }, false);

//             //clear event
//             clearButton.addEventListener('click', function(e) {
//                 //clear photos
//                 photos.innerHTML = '';
//                 //change filter back to normal
//                 filter = 'none';
//                 video.style.filter = filter;
//                 //reset select list to normal
//                 photoFilter.selectIndex = 0;
//             });

            saveButton.addEventListener('click', function() {
                image = canvas.toDataURL('images/png');
                document.getElementById('hidden_data').value = image;
            });
//             bandena.addEventListener("click", function() {
//                // const context = canvas.getContext('2d');
//                 let fetchImg = bandena.setAttribute("src", "../stickers/bandena.png")
//                 let stickerobj = new Image();
//                 stickerobj.src = "../stickers/bandena.png";
//                 stickerobj.onload = function()
//                 {
//                     canvas.drawImage(stickerobj, 0, 0, 75, 75);
//                 }

//                    /* let b_id = document.getElementById('bandena').src;
//                     console.log(b_id);
//                     context.drawImage(b_id, 0, 0, 75, 75);*/
//                     alert('Bandena button has been clicked');
//             });
//            /* sticker2.addEventListener("click", function() {
//                 context.drawImage(bunnyears, 400, 0, 100, 100);
//             });
//             sticker3.addEventListener("click", function() {
//                 context.drawImage(glasses, 0, 400, 100, 100);
//             });
//             sticker4.addEventListener("click", function() {
//                 context.drawImage(gradframe, 400, 400, 100, 100);
//             });*/


//             //filter event
//             photoFilter.addEventListener('change', function(e) {
//                 //set filter to chosen option
//                 filter = e.target.value;
//                 //set filter to video
//                 video.style.filter = filter;
//             })

//             //take picture from canvas
//             function take() {
//                 //create canvas
//                 const context = canvas.getContext('2d');
//                 if(width && height){
//                      //set canvas props
//                     canvas.width = width;
//                     canvas.height = height;

//                     //Draw an image of the video on the canvas

//                     context.drawImage(video, 0, 0, width, height); 
//                     //creating an image from the canvas
//                     const imgUrl = canvas.toDataURL('image/png');
//                     // create img element
//                     const img = document.createElement('img');
//                     //set img src
//                     img.setAttribute('src', imgUrl);

//                     //set image filter
//                     img.style.filter = filter;
//                     //Add image to photos
//                     photos.appendChild(img);
//                 }

    

//             }

