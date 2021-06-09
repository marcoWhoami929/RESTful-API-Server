<?php
/**
 *
 * @File:       Database.php
 * @Version:    $Rev:$ 1.0
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
    //@insertar un nueva cita
    public function nuevaCita($array)
    {
        $stmt = $this->conn->prepare("INSERT INTO cita(nombreCita,idPaciente,idMedico,idConsultorio,idTipoCita,notas,fechaCita,horaCita) VALUES(:nombreCita,:idPaciente,:idMedico,:idConsultorio,:idTipoCita,:notas,:fechacita,:horaCita)");

        $stmt-> bindParam(":nombreCita",$array["nombreCita"],PDO::PARAM_STR);
        $stmt-> bindParam(":idPaciente",$array["idPaciente"],PDO::PARAM_INT);
        $stmt-> bindParam(":idMedico",$array["idMedico"],PDO::PARAM_INT);
        $stmt-> bindParam(":idConsultorio",$array["idConsultorio"],PDO::PARAM_INT);
        $stmt-> bindParam(":idTipoCita",$array["idTipoCita"],PDO::PARAM_INT);
        $stmt-> bindParam(":notas",$array["notas"],PDO::PARAM_STR);
        $stmt-> bindParam(":fechacita",$array["fechacita"],PDO::PARAM_STR);
        $stmt-> bindParam(":horaCita",$array["horaCita"],PDO::PARAM_STR);

       if($stmt->execute()){

         return "ok";

       }else{

        return "error";

       }


    }
    //@ver lista de citas
    public function verCita(){

        $stmt = $this->conn->prepare("SELECT * FROM citas");

        $stmt -> execute();

        return $stmt-> fetchAll();

    }
    //@ver una cita
    public function verCitaId($id){

        $stmt =  $this->conn->prepare("SELECT * FROM citas where id = '$id'");

        $stmt -> execute();

        return $stmt-> fetch();

    }
    //@eliminar cita
    public function eliminarCita($id){

        $stmt = $this->conn->prepare("DELETE FROM citas  where id = '$id'");

        $stmt-> execute();

        $affected = $stmt->rowCount();

        if($affected != 0){

            return "ok";

        }else{

            return "error";

        }



    }
    //@update cita
    public function actualizarCita($array)
    {
        $stmt = $this->conn->prepare("UPDATE citas set nombreCita = :nombreCita where id = :id");

        $stmt-> bindParam(":id",$array["id"],PDO::PARAM_STR);
        $stmt-> bindParam(":nombreCita",$array["nombreCita"],PDO::PARAM_STR);

       
        $stmt->execute();

        $affected = $stmt->rowCount();

       if($affected != 0){

         return "ok";

       }else{

        return "error";

       }


    }
     //@nuevo paciente
    public function nuevoPaciente($array)
    {
        $stmt = $this->conn->prepare("INSERT INTO pacientes(nombreCompleto, email, password, direccion,ciudad,telefono,celular,nombreCompletoPadre,nombreCompletoMadre) VALUES(:nombreCompleto, :email, :password, :direccion,:ciudad,:telefono,:celular,:nombreCompletoPadre,:nombreCompletoMadre)");

        $stmt-> bindParam(":nombreCompleto",$array["nombreCompleto"],PDO::PARAM_STR);
        $stmt-> bindParam(":email",$array["email"],PDO::PARAM_STR);
        $stmt-> bindParam(":direccion",$array["direccion"],PDO::PARAM_STR);
        $stmt-> bindParam(":ciudad",$array["ciudad"],PDO::PARAM_STR);
        $stmt-> bindParam(":telefono",$array["telefono"],PDO::PARAM_STR);
        $stmt-> bindParam(":celular",$array["celular"],PDO::PARAM_STR);
        $stmt-> bindParam(":nombreCompletoPadre",$array["nombreCompletoPadre"],PDO::PARAM_STR);
        $stmt-> bindParam(":nombreCompletoMadre",$array["nombreCompletoMadre"],PDO::PARAM_STR);

     

       if($stmt->execute()){

         return "ok";

       }else{

        return "error";

       }


    }
 
}
 
?>