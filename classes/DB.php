<?php

class DB {
  //get instance function allows you to use the database without having to create an instance everytime.
  private static $_instance = null; //this property stores the instance of the db.
  private $_pdo; //stores the instantiated pdo object
  private $_query; //stores last query executed
  private $_error = false; //stores errors
  private $_results; //stores the result
  private $_count = 0; //count of results

  private function __construct()
  {
      try
      {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host'). ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }
      catch(PDOException $e)
      {
          die($e->getMessage());
      }
  }
  //below method checks if we have instatiated a connection to database
  //if not connected to db yet it will connect
  //if already connected, it will use the object of the conntection
  //self:: is bacause we are using a static method on private property
  public static function getInstance()
  {
      if(!isset(self::$_instance))
      {
          self::$_instance = new DB();
      }
      return self::$_instance;

  }

//provides the functionality to query a database
  public function query($sql, $parameter = array())
  {
      $this -> _error = false; // reset error back to false so we not returning an error for previous query
    //   var_dump($this->_pdo);
    //   die();
      if($this->_query = $this->_pdo->prepare($sql))
      {
          $x = 1;
          //check if parameters exits for binding and quering
          if(count($parameter))
          {
              foreach($parameter as $param)
              {
                  $this->_query->bindValue($x, $param);
                  $x++;
                  // the above statements bind the value at position 1(x=1) to the 1st parameter. 
              }
            
          }
        }
        //this is the actual statement that queries the db
        //if table name not correct it will return error message
        if($this->_query->execute())
        {
            //the found query values are stored in the property results, which will be returned by the results method.
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            //if the query is successful or not the number of rows affected by the query is stored in count property and return by the count method
            $this->_count = $this->_query->rowCount();
            
        }
        else
        {
            $this->_error = true;
        }
        return $this;

}

public function action($action, $table, $where = array())
{
    if(count($where) == 3) //table field, = , userinpu
    {
        $operators = array('=', '>', '<', '>=', '<='); // allowed operators

        $field = $where[0];
        $operator = $where[1];
        $value = $where[2];

        // check if operator is inside the operators array
        if(in_array($operator, $operators))
        {
            //$sql = "SELECT * FROM users WHERE username = 'Alex' ";
            $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
            //if there is not an error, return the below
            if(!$this->query($sql, array($value))->error())
            {
                return $this;
            }
        }
    }
    return false;

}

public function get($table, $where)
{
    return $this->action('SELECT *', $table, $where);

}

public function delete($table, $where)
{
    return $this->action('DELETE *', $table, $where);

}

public function insert($table, $fields = [])
{
    $fieldString = '';
    $valueString = '';
    $values = [];
    foreach($fields as $field => $value)
    {
        $fieldString .= '`' . $field . '`,';
        $valueString .= '?,';
        $values[] = $value;
    }
    $fieldString = rtrim($fieldString, ',');
    $valueString = rtrim($valueString, ',');
    $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
    if (!$this->query($sql, $values)->error()){
        return true;
    }
    return false;
}

public function update($table, $id, $fields = [])
{
    $set = '';
    $x = 1;

    foreach($fields as $name => $value)
    {
        $set .= "{$name} = ?";
        if($x < count($fields))
        {
            $set .= ', ';
        }
        $x++;
    }
    $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
    if(!$this->query($sql, $fields)->error())
    {
        return true;
    }
    return false;
}

public function results()
{
    return $this->_results;

}
//method to return the first results or row found by results method
public function first()
{
    return $this->results()[0];

}
public function error(){
    return $this->_error;
}

public function count(){
    return $this->_count;
}


}