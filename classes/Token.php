<?php 
/*token is used to only allow data from this form to be posted back.
    1)allows us to generate a token.
    2)check if a token is valid/ exits.
    3)delete the token.
    4)the token is generated for each refresh of the page, so the token is only valid for that time frame.
     Process:
        var_dump(Token::check(Input::get('token')));
        as soon as form is submitted, token gets the session token supplied in the form, the then check 
        cheks if the token exists and if it matche the session, then it gets deleted and returns true.*/

    class Token
    {
        public static function generate()
        {
            //generates the token as per session
            return Session::put(Config::get('session/token_name'), md5(uniqid()));
        }

        public static function check($token)
        {
            // checks if the token exists and delete the session
            $tokenName = Config::get('session/token_name');

            if(Session::exists($tokenName) && $token === Session::get($tokenName))
            {//above checks if the token name received from get exists and if the same as current session tokenName
                Session::delete($tokenName);
                return true;
            }
            return false;

        }

    }



?>