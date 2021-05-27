<?php

// class DB{
//    static public function connect(){
//        $db = new PDO("mysql:host=localhost;dbname=mvc","root","");
//        $db->exec("set names utf8");
//        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
//        return $db;
//    }
// }

class Connection
{
   public $servername = 'localhost';
   public $username = 'root';
   public $dbname = 'mvc';
   public $password = '';
   private  $sql;


   function __construct()
   {
      try {
         $this->sql = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      } catch (PDOException $e) {
         echo "connection failde: " . $e->getMessage();
      }
   }

   //    --------------------------------------select

   function select($table)
   {
      $qry = "select * from " . $table;
      return $this->sql->query($qry)->fetchAll();
   }

   //    --------------------------------------delete

   function delete($table, $id)
   {
      $qry = "delete from " . $table . " where id=" . $id;
      $this->sql->query($qry);
   }

   //    --------------------------------------insert

   function insert($table, $tabName, $tabValue)
   {
      $name = "";
      $value = "";
      $vrg = "";
      for ($i = 0; $i < count($tabName); $i++) {
         if ($i > 0) {
            $vrg = ",";
         }

         $name .= $vrg . "`" . $tabName[$i] . "`";
      }

      $vrg = "";
      for ($i = 0; $i < count($tabValue); $i++) {
         if ($i > 0) {
            $vrg = ",";
         }
         $value .= $vrg . "'" . $tabValue[$i] . "'";
      }
      $qry = "INSERT INTO " . $table . " (" . $name . ") VALUES (" . $value . ")";
      $this->sql->query($qry);
   }

   //    --------------------------------------update

   function update($table, $tabName, $tabValue, $id)
   {
      $name = "";
      $value = "";
      for ($i = 0; $i < count($tabName); $i++) {
         $vrg = "";
         if ($i > 0) {
            $vrg = ",";
         }
         $name .= $vrg . "`" . $tabName[$i] . "`='" . $tabValue[$i] . "'";
      }

      $qry = "UPDATE " . $table . " SET " . $name . " WHERE id=" . $id;
      $this->sql->query($qry);
   }

   //    --------------------------------------select

   function edit($table, $id)
   {
      $qry = "select * from " . $table . " where id=" . $id;
      $stm = $this->sql->prepare($qry);
      $stm->execute();
      $row = $stm->fetch(PDO::FETCH_OBJ);
      return $row;
   }



   function one($table, $Email)
   {
         // $qry = "select * from " . $table . " where Email=" . $Email;
         $qry = "SELECT * FROM user WHERE Email = '$Email'";
         
         
         $stm = $this->sql->prepare($qry);
         $stm->execute();
         $row = $stm->fetch(PDO::FETCH_OBJ);
         return $row;
      
   }
}
