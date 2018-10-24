<?php

namespace Melper;

abstract class MelperModel
{
  //class mère de tous les modèle, intéragissant ave la base de données
  protected $mysqlConnect;

  function __construct() {

    try {
    $this->mysqlConnect = new \PDO('mysql:host=localhost;dbname=' . $GLOBALS["config"]["SGBDDatabase"]
    , $GLOBALS["config"]["SGBDUser"], $GLOBALS["config"]["SGBDPass"], [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    ]);
    } catch(\PDOException $e) {
      throw new \PDOException($e->getMessage(), $e->getCode());
    }
    //var_dump($this->$dbConnec); die;
  }

  public function getAll()
  {

    $sql = 'SELECT * FROM '. $this->table . ' ORDER BY `Nom` ASC' ;
    $request = $this->mysqlConnect->prepare($sql);
    $request->execute();
    return $request->fetchAll();

   }

   public function getOne($column, $value)
   {
     $request = $this->mysqlConnect->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value');
     $request->execute(['value' => $value]);
     $result = $request->fetch();
     if($result !== null){
       return $result;
     } else {
       return false;
     }
   }

   public function getOrder($column, $value)
   {
     $request = $this->mysqlConnect->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :value');
     $request->execute(['value' => $value]);
     $result = $request->fetch();
     if($result !== null){
       return $result;
     } else {
       return false;
     }
   }

   public function getOneById($value)
   {
     $request = $this->mysqlConnect->prepare('SELECT * FROM ' . $this->table . ' WHERE id = :value');
     $request->execute(['value' => $value]);
     $result = $request->fetch();
     if($result !== null){
       return $result;
     } else {
       return false;
     }
   }

   public function updateClient()
   {
      $sql = 'UPDATE client 
        SET `Nom` = "' . $_POST["nom"] . '"
        , `Prenom` = "' . $_POST["prenom"] . '"
        , `Age` = ' . $_POST["age"] . '
        , `Telephone` = ' . $_POST["telephone"] . '
        , `Adresse` = "' . $_POST["adresse"] . '"
        , `CP` = ' . $_POST["codepostal"] . ' 
        WHERE `id` = ' . $_POST["id"] . ";";
      $requestHome = $this->mysqlConnect->prepare($sql);
      //var_dump($requestHome);
      //var_dump('UPDATE ' . $this->table . ' SET Order = ' . $newOrderHome . ' WHERE title = "home"');
      $requestHome->execute();

   }

   public function deleteClient() {
     
   }
}