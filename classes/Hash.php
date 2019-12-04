<?php
    //we want to generate a one way hash, which ever algorith is secure

class Hash
{
    //salt generates random numbers which is added to a string. improves the security of a random hash.
    public static function make($string, $salt = '')
    {
        return hash('sha256', $string . $salt);

    }

    public static function salt($length)
    {
        return random_bytes($length);
    }

    public static function unique()
    {
        return self::make(uniquid());

    }
    
}

?>