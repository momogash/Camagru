//global variables
        let width = 500,
            height = 500,
            filter = 'none',
            streaming = false;

         navigator.getUserMedia = (navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia || 
                            navigator.msGetUserMedia);

        //DOM elements
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const  stickerCanvas = document.getElementById('overlay');

        const context = stickerCanvas .getContext('2d');

        const photos = document.getElementById('photos'); //pics at the bottom
        const photoButton = document.getElementById('photo-button'); //take picture button
        const clearButton = document.getElementById('clear-button'); //clear button
        const photoFilter = document.getElementById('photo-filter'); //filter button
        const saveButton = document.getElementById('image_saver'); //save button

        const sticker1 = document.getElementById('sticker_1');
        const sticker2 = document.getElementById('sticker_2');
        const sticker3 = document.getElementById('sticker_3');
        const sticker4 = document.getElementById('sticker_4');
        const bandena = document.getElementById('bandena');
        const bunnyears = document.getElementById('bunnyears');
        const glasses = document.getElementById('glasses');
        const gradframe = document.getElementById('gradframe');



        //get media stream
        navigator.mediaDevices.getUserMedia({video: true, audio: false})
            .then(function(stream){
                //link video sauce form form
                video.srcObject = stream;
                //play vieo
                video.onloadmetadata = function(e) {
                     video.play();

                }
               
            })
            .catch(function(err){
                console.log(`Error: ${err}`);
            });

            //paly when ready
            video.addEventListener('canplay',function(e){
                if(!streaming){
                    //set vieo / canvas height
                    height = video.videoHeight / (video.videoWidth / width);
                    video.setAttribute('width', width); //sets the html attribute
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);

                    streaming = true;
                }
            }, false);
            //photo button event
            photoButton.addEventListener('click', function(e){
                takePicture();

                e.preventDefault();
            }, false);

            //clear event
            clearButton.addEventListener('click', function(e) {
                //clear photos
                photos.innerHTML = '';
                //change filter back to normal
                filter = 'none';
                video.style.filter = filter;
                //reset select list to normal
                photoFilter.selectIndex = 0;
            });

            saveButton.addEventListener('click', function() {
                image = canvas.toDataURL('images/png');
                document.getElementById('hidden_data').value = image;
            });
            sticker1.addEventListener("click", function() {
                context.drawImage(bandena, 0, 0, 100, 100);
            });
            sticker2.addEventListener("click", function() {
                context.drawImage(bunnyears, 400, 0, 100, 100);
            });
            sticker3.addEventListener("click", function() {
                context.drawImage(glasses, 0, 400, 100, 100);
            });
            sticker4.addEventListener("click", function() {
                context.drawImage(gradframe, 400, 400, 100, 100);
            });


            //filter event
            photoFilter.addEventListener('change', function(e) {
                //set filter to chosen option
                filter = e.target.value;
                //set filter to video
                video.style.filter = filter;
            })

            //take picture from canvas
            function takePicture() {
                //create canvas
                const context = canvas.getContext('2d');
                if(width && height){
                     //set canvas props
                    canvas.width = width;
                    canvas.height = height;

                    //Draw an image of the video on the canvas

                    context.drawImage(video, 0, 0, width, height); 
                    //creating an image from the canvas
                    const imgUrl = canvas.toDataURL('image/png');
                    // create img element
                    const img = document.createElement('img');
                    //set img src
                    img.setAttribute('src', imgUrl);

                    //set image filter
                    img.style.filter = filter;
                    //Add image to photos
                    photos.appendChild(img);
                }
            }

