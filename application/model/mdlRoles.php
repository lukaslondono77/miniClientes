<?php
class mdlRoles{
    //atributos
    public $idRol;
    public $descripcion;
    public $estado;
    public $db;

    //crear el constructor
    public function __construct($db){
        try{
            $this->db = $db;
        }catch(PDOException $e){
            exit("Error al conectar a la base datos");
        }
    }

    //método para fijar los datos 
    public function __SET($atributo, $valor){
        //instanciar la variable atributo que será la que guarde los valores principales
        $this->$atributo = $valor;
    }

    //método para reclamar los datos cuando sean necesarios
    public function __GET($atributo){
        //la variable atributo es la que controla, envia y reclama los datos
        return $this->$atributo;
    }

    //////////////////////////////////////////////////////////////////REGISTRAR ROLES//////////////////////////////////////////////////
    public function registrarRoles(){
        //crear la consulta
        $sql = "INSERT INTO roles(Descripcion,Estado) values (?,?)";
        $stm = $this->db->prepare($sql);
        $stm -> bindParam(1, $this->descripcion);
        $stm -> bindParam(2, $this->estado);
        $resultado = $stm->execute();
        return $resultado;
    }

    public function ultimoIdRol(){
        //crear la consulta para verificar
        $sql = "SELECT MAX(idRol) AS ultimoIdRol FROM roles";
        //vamos a prepara la consulta para ser enviada
        $query = $this->db->prepare($sql);
        $query->execute();
        $ultimoId = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ultimoId;
    }
  //////////////////////////////////////////////////////////////////REGISTRAR ROLES//////////////////////////////////////////////////
    
  
  //////////////////////////////////////////////////////////////////GET ROLES////////////////////////////////////////////////////////
    //método para ver los roles
    public function getRoles(){
        //crear la consulta
        $sql = "SELECT * FROM roles ORDER BY Descripcion ASC";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
 //////////////////////////////////////////////////////////////////GET ROLES////////////////////////////////////////////////////////
    
 
 ////////////////////////////////////////////////////////////EDITAR,FILTAR Y ELIMINAR////////////////////////////////////////////////////////
 //método para tomar el id, filtrar, editar, eliminar y cambiar estado en roles
    public function rolId($id){
        $sql = "SELECT idRol,Descripcion, Estado From roles where idRol=?";

        //preparación y ejecución de la consulta
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
 ////////////////////////////////////////////////////////////EDITAR,FILTAR Y ELIMINAR////////////////////////////////////////////////////////
    
 
 ////////////////////////////////////////////////////////////CAMBIAR ESTADO////////////////////////////////////////////////////////
    public function changeStatusRole($id){
        //consulta
        $sql ="UPDATE roles SET Estado = (CASE WHEN Estado = 1 THEN 0 ELSE 1 END) WHERE idRol = ?";

        $query = $this->db->prepare($sql);
        $query->bindParam(1, $id);
        return $query->execute();
    }
 ////////////////////////////////////////////////////////////CAMBIAR ESTADO////////////////////////////////////////////////////////


 ////////////////////////////////////////////////////////////ACTUALIZAR////////////////////////////////////////////////////////
     public function updateRoles(){
        //consulta
        $sql = "UPDATE roles as R inner join usuarios as U on U.idRol=R.idRol set Descripcion=?";

        //preparar la consulta y enviarla
        $stm = $this->db->prepare($sql);
        $stm -> bindParam(1, $this->Descripcion);
        //respuesta
        $result = $stm->execute();
        return $result;
    }
 ////////////////////////////////////////////////////////////ACTUALIZAR////////////////////////////////////////////////////////


 ////////////////////////////////////////////////////////////ELIMINAR////////////////////////////////////////////////////////

    public function deleteRole($id){
        //consulta
        $sql = "DELETE from roles WHERE idRol=?;
        ALTER TABLE roles AUTO_INCREMENT = 1";

        $query = $this->db->prepare($sql);
        $query -> bindParam(1,$id);
        return $query->execute();
    }
 ////////////////////////////////////////////////////////////ELIMINAR////////////////////////////////////////////////////////




}

?>