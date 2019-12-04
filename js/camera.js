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
        const photos = document.getElementById('photos');
        const photoButton = document.getElementById('photo-button');
        const clearButton = document.getElementById('clear-button');
        const photoFilter = document.getElementById('photo-filter');



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

