<?php

//crear la clase para heredar del controlador
class rolesController extends Controller{

    private $modeloR;

    //crear el constructor que llamará del modelo la base de datos
    public function __construct(){
        //instanciar los modelos
        $this->modeloR = $this->loadModel("mdlRoles");

    }

    //registrar roles
    public function roleREgister(){
      //con condicional para el formulario
      if(isset($_POST['btnRegister'])){
        //comunicación modelo y formulario
      
        $this->modeloR->__SET('descripcion', $_POST['txtDescripcion']);
        $this->modeloR->__SET('estado', $_POST['selStatus']);
       
        //vamos a crear una variable que llamará al método del modelo para poder registrar los datos
        $rol = $this->modeloR->registrarRoles();

        //validamos que registre desde la último rol registrado
        if($rol == true){
            $ultimoId = $this->modeloR->ultimoIdRol();
            //foreach que se encarga de tomar los datos explicitos
            foreach($ultimoId as $value){
                $ultimoIdValue = $value['ultimoIdRol'];
            }
        }


        //aquí vamos a estilizar con la librería sweetalert2
        if($rol == true){
            $_SESSION["alert"] = "Swal.fire({
                position:'',
                icon: 'success',
                title: 'Done',
                showConfirmButton: false,
                timer: 1500})";

                header("Location: " .URL."rolesController/roleREgister");
                exit();
        }else{
            $_SESSION["alert"] = "Swal.fire({
                position:'',
                icon: 'error',
                title: 'Error',
                showConfirmButton: false,
                timer: 3000})";

                header("Location: " .URL."rolesController/roleREgister");
                exit();
            }
        }

        if(isset($_POST['btnUpdate'])){
        //comunicación modelo y formulario
       $this->modeloR->__SET('Descripcion', $_POST['txtDescripcion']);

       //variable para el actualizar
       $update = $this->modeloR->updateRoles();

       //sweetalert
       if($update==true){
           $_SESSION['alert'] = "Swal.fire({
               position:'',
               icon: 'success',
               title: 'Done',
               showConfirmButton: false,
               timer: 1500})";

               header("Location: " .URL."rolesController/roleREgister");
               exit();
       }else{
           $_SESSION["alert"] = "Swal.fire({
               position:'',
               icon: 'error',
               title: 'Error',
               showConfirmButton: false,
               timer: 3000})";

               header("Location: " .URL."rolesController/roleREgister");
               exit();
            }
       
        }

        //variables para traer los demás métodos necesarios
        $roles = $this->modeloR->getRoles();

        require APP . 'view/_templates/header.php';
        require APP . 'view/roles/getRoles.php';
        require APP . 'view/_templates/footer.php';
  
    }

    //función para traer el ID del modelo
    public function dataRoles(){
        //crear una variable para controlar el dato
        $dataRoles = $this->modeloR->rolId($_POST['id']);
        echo json_encode($dataRoles);
    }
    
    public function changeStatusRole(){
        //crear una variable para controlar el dato
        $dataRoles = $this->modeloR->changeStatusRole($_POST['id']);
        echo 1;
    }

    public function deleteRole(){
        $dataRoles = $this->modeloR->deleteRole($_POST['id']);
        echo 1;
    }

}

?>