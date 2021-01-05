<?php
/**
 *
 * @About:      Database connection manager class
 * @File:       Database.php
 * @Date:       $Date:$ Nov-2015
 * @Version:    $Rev:$ 1.0
 * @Developer:  Federico Guzman (federicoguzman@gmail.com)
 * @Developer Modified:  Marco Antonio Lopez Perez (disprosoft@gmail.com)
 * @Date:     $Date:$ Enero 2021
 * @Version:    $Rev:$ 1.1
 **/
class DbHandler {
 
    private $conn;
 
    function __construct() {
        require_once dirname(__FILE__) . './DbConnect.php';
        //abriendo conexion
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
    //@insertar un nuevo auto
    public function createAuto($array)
    {
        $stmt = $this->conn->prepare("INSERT INTO auto(make,model,year,msrp) VALUES(:make,:model,:year,:msrp)");

        $stmt-> bindParam(":make",$array["make"],PDO::PARAM_STR);
        $stmt-> bindParam(":model",$array["model"],PDO::PARAM_STR);
        $stmt-> bindParam(":year",$array["year"],PDO::PARAM_STR);
        $stmt-> bindParam(":msrp",$array["msrp"],PDO::PARAM_STR);

       if($stmt->execute()){

         return "ok";

       }else{

        return "error";

       }


    }
    //@ver auto
    public function showAuto(){

        $stmt = $this->conn->prepare("SELECT * FROM auto");

        $stmt -> execute();

        return $stmt-> fetchAll();

    }
    //@ver un unico auto
    public function showAutoId($id){

        $stmt =  $this->conn->prepare("SELECT * FROM auto where id = '$id'");

        $stmt -> execute();

        return $stmt-> fetch();

    }
    //@eliminar auto
    public function deleteAuto($id){

        $stmt = $this->conn->prepare("DELETE  FROM auto  where id = '$id'");

        $stmt-> execute();

        $affected = $stmt->rowCount();

        if($affected != 0){

            return "ok";

        }else{

            return "error";

        }



    }
    //@update auto
    public function updateAuto($array)
    {
        $stmt = $this->conn->prepare("UPDATE auto set year = :year where id = :id");

        $stmt-> bindParam(":id",$array["id"],PDO::PARAM_STR);
        $stmt-> bindParam(":year",$array["year"],PDO::PARAM_STR);

       
        $stmt->execute();

        $affected = $stmt->rowCount();

       if($affected != 0){

         return "ok";

       }else{

        return "error";

       }


    }
 
}
 
?>