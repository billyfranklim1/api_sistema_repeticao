<?php
 
class DbOperation
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
 
 /*
 * The create operation
 * When this method is called a new record is created in the database
 */
 function createCard($Frente, $Costa){
 $stmt = $this->con->prepare("INSERT INTO carta (idCarta, Frente, Costa) VALUES (NULL, ?, ?)");
 $stmt->bind_param("ss", $Frente, $Costa);
 if($stmt->execute()){
    return true;    
 }else{
    return false;    
 }
 }
 
 /*
 * The read operation
 * When this method is called it is returning all the existing record of the database
 */
 function getCard(){
 $stmt = $this->con->prepare("SELECT idCarta, Frente, Costa FROM carta");
 $stmt->execute();
 $stmt->bind_result($idCarta, $Frente, $Costa);
 
 $carta = array(); 
 
 while($stmt->fetch()){
 $cartas  = array();
 $cartas['idCarta'] = $idCarta; 
 $cartas['Frente'] = $Frente; 
 $cartas['Costa'] = $Costa; 
  
 array_push($carta, $cartas);  
 }
 return $carta; 
 }
 
 /*
 * The update operation
 * When this method is called the record with the given id is updated with the new given values
 */
 function updateCard($idCarta, $Frente, $Costa){
 $stmt = $this->con->prepare("UPDATE carta SET Frente = ?, Costa = ? WHERE idCarta = ?");
 $stmt->bind_param("ssi", $Frente, $Costa, $idCarta);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 
 /*
 * The delete operation
 * When this method is called record is deleted for the given id 
 */
 function deleteCard($idCarta){
 $stmt = $this->con->prepare("DELETE FROM carta WHERE idCarta = ? ");
 $stmt->bind_param("i", $idCarta);
 if($stmt->execute())
 return true; 
 
 return false; 
 }

 function getRandomCard(){
 $stmt = $this->con->prepare("SELECT idCarta, Frente, Costa FROM carta ORDER BY RAND()");
 $stmt->execute();
 $stmt->bind_result($idCarta, $Frente, $Costa);
 
 $card = array(); 
 
 while($stmt->fetch()){
 $cards  = array();
 $cards['idCarta'] = $idCarta; 
 $cards['Frente'] = $Frente; 
 $cards['Costa'] = $Costa; 
  
 array_push($card, $cards);  
 }
 return $card; 
 }
 
}
?>