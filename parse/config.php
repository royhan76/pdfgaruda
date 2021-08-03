<?php

class Config {

var $konek_db;

    function __construct($kon)
    {
        $this->konek_db=$kon;
    }
    
    function select_header()
    {
       $query = "SELECT * FROM `header`";
       $sql = mysqli_query($this->konek_db, $query);

       if(!$sql){
           $hasil = 0;
       }
      
       return $sql;
    }
    public function insertAuthorHeader($author_header_id,$author_id, $nadep, $nabel)
    {
        $query = "INSERT INTO `author_header` (`author_header_id`, `author_id`, `author_firstname`, `author_lastname`) VALUES ('{$author_header_id}', '{$author_id}', '{$nadep}', '{$nabel}')"; 
        $sql = mysqli_query($this->konek_db, $query);
        if(!$sql){
            $hasil =0;
        }
        return $sql;
    }
	

}

?>
