<?php
//checks if any data exists
//retrieve an item

class Input
{
    //exists method checks if data has been submitted. by default we will process post data, otherwise get
    public static function exists($type = 'post')
    {
        switch($type)
        {
            case 'post':
                return (!empty($_POST)) ? true : false;

            break;
            case 'get':
                return (!empty($_GET)) ? true : false;

            break;
            default:
                return false;
            break;
        }
    }
    // get method checks if the data has been  set
    //provides the ability to grab inputted data
    public static function get($item) 
    { 
        if(isset($_POST[$item]))
        {
            return ($_POST[$item]);
        }
        else if(isset($_GET[$item]))
        {
            return $_GET[$item];
        }
        //if the post data is not set we still want to return something.hence the empty string.
        return '';
    }
}
?>