<?php
// detect if data has been passed or not
// check for errors and store the errors
// create an instance of the database(connect to db). the construct function will be doing the connection for us
    Class Validate
    {
        private $_passed = false;
        private $_errors = array();
        private $_db = null;

        public function __construct()
        {
            //_db is now an instance of the class db and uses getInstance method to connect to db
            $this->_db = DB::getInstance();
        }

        public function check($source, $items = array())
        {
            // to this function we are passing the post data recievedm in register.php from the form 
            //also passing in the set of rules that were defined in register.php
            //now loop through the rules that we defined contained in $items
            //check it against the $source provided and then add it to the errors array.
            //print_r($source);
            foreach($items as $item => $rules)
            { //$rules is the array of each item.(set of rules contained in username)
                foreach($rules as $rule => $rule_value)
                {
                    //echo "{$item} {$rule} must be {$rule_value}<br>";
                    $value = $source[$item];
                    $item = escape($item);
                    //echo $value."\n";
                    //echo $rule;
                    

                    //checking if the required value is empty
                    if($rule === 'required' && empty($value))
                    {
                        $this->addError("{$item} is required");
                    }
                    else
                    {
                        if(!empty($value))
                        {
                            switch($rule)
                            {
                                case 'min':
                                    if(strlen($value) < $rule_value){
                                    $this->addError("{$item} must be a mininum of {$rule_value} characters.");
                                    }
                                break;
                                case 'max':
                                    if(strlen($value) > $rule_value){
                                    $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                                    }
                                break;
                                case 'matches':
                                    if($value != $source[$rule_value])
                                    {
                                        $this->addError("{$rule_value} must match {$item}");
                                    }

                                break;
                                 case 'unique':
                                    $check = $this->_db->get($rule_value, array($item, '=', $value));
                                    if($check->count())
                                    {
                                        $this->addError("{$item} already exists.");
                                    }
                                break;
                            }
                        }
 
                    }

                    /*
                    the below statement shows all the rules set
                    echo "{$item} {$rule} must be {$rule_value}<br> ";
                    now that we have access to each of the rules of each field of the form. now we grab the value of each item.
                    */
                    
            
                }


            }
            //check if the errors array is empty, and if empty it means no errors, so validation has passed.
            if(empty($this->_errors))
            {
                $this->_passed = true;
            }
            return $this;

        }
        //stores errors
        private function addError($error)
        {
            $this->_errors[] = $error;
           
        }
        //displays errors
        public function errors()
        {
            return $this->_errors;
        }
        public function passed()
        {
            return $this->_passed;
        }
        

    }
?>