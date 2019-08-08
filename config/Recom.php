<?php 

class Recom extends Database
{
  public function create_recom($fields){
    try{
      $implodeColumns = implode(', ', array_keys($fields));
      $implodePlaceholders = implode(", :", array_keys($fields));
      $sql = "INSERT INTO movie ($implodeColumns) VALUES (:".$implodePlaceholders.")";
      $stmt = $this->connect()->prepare($sql);
      foreach($fields as $k => $value){
        $stmt->bindValues(':'.$k,$value);
      }
      $execute = $stmt->execute();

      if($execute){
        header('Location: index');
        return true;
      }else{
        $this->showError($stmt);
        return false;
      }

    }catch(PDOException $e){
      echo 'error on creation ' .$e->getMessage();
    }
  }
  public function read_recom(){

  }
  public function update_recom(){
    
  }
  public function delete_recom(){
    
  }
}

?>