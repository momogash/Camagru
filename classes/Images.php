<?php
class Images
{
    private $image_id;
    private $image_name;
    private $image;

    public function insert_image()
    {
        //'txt_image'received from upload input tag in gallery html name.
        if($_FILES["txt_image"])
        {
            print_r($_FILES);
            $tmpname = $_FILES["txt_image"]["tmp_name"];
            $originalname = $_FILES["txt_image"]["name"];
            $size = ($_FILES["txt_image"]["size"]/ 5242880) . "MB<br>";
            $type = $_FILES["txt_image"]["type"];
            $image = $_FILES["txt_image"]["name"];
            move_uploaded_file($_FILES["txt_image"]["tmp_name"],"images/".$_FILES["txt_image"]["name"]);
        }
       $upload = DB::getInstance()->insert('images',array(
            'image_name' => $this->$tmpname,
            'image' => $this->$image
        ));
        if($upload)
        {
            echo 'suceess';
        }
        else
        {
            echo 'error';
        }

    }
}

?>