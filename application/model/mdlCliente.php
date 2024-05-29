<?php
//este modelo hereda del padre o mdlPersona
require_once("mdlPersona.php");

//heredamos la clase
class mdlCliente extends mdlPersona{
    //atributos
    private $idCliente;
    private $idTipoCliente;
    
    private $estado;

    //siempre en las clases serán necesarios los métodos get y set para los datos
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

    //////////////////////////////////////////////////////////////////REGISTRAR Clientes//////////////////////////////////////////////////

    public function ClientRegister(){
        //crear la consulta
        $sql = "INSERT INTO clientes(idTipoCliente,idPersona,Estado) values (?,?,?)";

        $estado = 1;
        
        $stm = $this->db->prepare($sql);
        $stm -> bindParam(1, $this->idTipoCliente);
        $stm -> bindParam(2, $this->idPersona);
        $stm -> bindParam(3, $estado);
        $resultado = $stm->execute();
        return $resultado;
    }

    public function ultimoIdCliente(){
        //crear la consulta para verificar
        $sql = "SELECT MAX(idCliente) AS ultimoIdCliente FROM clientes";
        //vamos a prepara la consulta para ser enviada
        $query = $this->db->prepare($sql);
        $query->execute();
        $ultimoId = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ultimoId;
    }
    //////////////////////////////////////////////////////////////////REGISTRAR ROLES//////////////////////////////////////////////////


    //////////////////////////////////////////////////////////////////GET Clientes////////////////////////////////////////////////////////
    //método para ver los clientes
    public function getClients(){
        //crear la consulta
        $sql = "SELECT p.idPersona, p.Documento, p.Nombre, p.Apellidos, p.Email, p.Telefono, p.Direccion, p.Genero, p.idTipoDocumento, c.idCliente, c.Estado, tc.descripcion AS TipoCliente, TD.* FROM personas p INNER JOIN clientes AS c ON p.idPersona = c.idPersona INNER JOIN tipocliente AS tc ON c.idTipoCliente = tc.idTipoCliente INNER JOIN tiposdocumentos AS TD ON p.idTipoDocumento= TD.idTipoDocumento";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    //////////////////////////////////////////////////////////////////GET Clientes////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////EDITAR,FILTAR Y ELIMINAR///////////////////////////////////////////////////////
 //método para tomar el id, filtrar, editar, eliminar y cambiar estado en roles
 public function clienteId($id){
    $sql = "SELECT c.*, p.idPersona, p.Documento, p.Nombre, p.Apellidos, p.Email, p.Telefono, p.idTipoDocumento,c.Estado,tc.descripcion as tipoCliente, c.idTipoCliente from personas p inner join clientes as c on p.idPersona = c.idPersona inner join tipocliente as tc on c.idTipoCliente = tc.idTipoCliente inner join tiposdocumentos as TD on p.idTipoDocumento= TD.idTipoDocumento where c.idCliente=?";

    //preparación y ejecución de la consulta
    $query = $this->db->prepare($sql);
    $query->bindParam(1, $id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
////////////////////////////////////////////////////////////EDITAR,FILTAR Y ELIMINAR////////////////////////////////////////////////////////



////////////////////////////////////////////////////////CAMBIAR ESTADO////////////////////////////////////////////////////////    
public function changeStatusClient($id){
    //consulta
    $sql ="UPDATE clientes SET Estado = (CASE WHEN Estado = 1 THEN 0 ELSE 1 END) WHERE idCliente = ?";

    $query = $this->db->prepare($sql);
    $query->bindParam(1, $id);
    return $query->execute();
}  

////////////////////////////////////////////////////////CAMBIAR ESTADO//////////////////////////////////////////////////////// 



////////////////////////////////////////////////////////AGREGAR EL TIPOCLIENTE//////////////////////////////////////////////////////// 
    
public function getTypeClient(){
    //crear la consulta
    $sql = "SELECT * FROM tipocliente ORDER BY descripcion ASC";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}
////////////////////////////////////////////////////////AGREGAR EL TIPOCLIENTE//////////////////////////////////////////////////////// 



////////////////////////////////////////////////////////////ELIMINAR////////////////////////////////////////////////////////
    //método para eliminar el usuario
    public function deleteClient($id){
        //consulta
        $sql = "DELETE U, P FROM usuarios AS U INNER JOIN personas AS P WHERE P.idPersona = U.idPersona AND U.idUsuario = ?;
        ALTER TABLE personas AUTO_INCREMENT = 1;
        ALTER TABLE usuarios AUTO_INCREMENT = 1
        ";

        $query = $this->db->prepare($sql);
        $query -> bindParam(1,$id);
        return $query->execute();
    }

////////////////////////////////////////////////////////////ELIMINAR////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////ACTUALIZAR////////////////////////////////////////////////////////

public function updateClient(){ 
    $sql = "UPDATE personas AS P INNER JOIN clientes AS C ON P.idPersona = C.idPersona INNER JOIN tipocliente AS TC ON C.idTipoCliente = TC.idTipoCliente SET P.idTipoDocumento = ?, P.Documento = ?, P.Nombre =?, P.Apellidos = ?, P.Telefono = ?, P.Email = ?, TC.descripcion=? WHERE C.idCliente=?"; 

    //preparar la consulta y enviarla
    $stm = $this->db->prepare($sql);
    $stm -> bindParam(1, $this->idTipoDocumento);
    $stm -> bindParam(2, $this->documento);
    $stm -> bindParam(3, $this->nombre);
    $stm -> bindParam(4, $this->apellidos);
    $stm -> bindParam(5, $this->telefono);
    $stm -> bindParam(6, $this->email);
    $stm -> bindParam(7, $this->descripcion);
    $stm -> bindParam(8, $this->idCliente);

     //respuesta
     $result = $stm->execute();
     return $result;
}

////////////////////////////////////////////////////////////ACTUALIZAR////////////////////////////////////////////////////////

}

?>