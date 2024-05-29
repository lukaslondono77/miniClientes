<?php

//crear la clase para heredar del controlador
class clientController extends Controller{

    private $modeloC;
    private $modeloU;

    //crear el constructor que llamará del modelo la base de datos
    public function __construct(){
        //instanciar los modelos
        $this->modeloC = $this->loadModel("mdlCliente");
        $this->modeloU = $this->loadModel("mdlUsuario");

    }

    //registrar Clientes
    public function clientRegister(){
      //con condicional para el formulario
      if(isset($_POST['btnRegister'])){
        //comunicación modelo y formulario
      
            $this->modeloC->__SET('idTipoDocumento', $_POST['selDocType']);
            $this->modeloC->__SET('documento', $_POST['txtDocument']);
            $this->modeloC->__SET('nombre', $_POST['txtNames']);
            $this->modeloC->__SET('apellidos', $_POST['txtLastName']);
            $this->modeloC->__SET('fechaNacimiento', $_POST['txtBirthdate']);
            $this->modeloC->__SET('telefono', $_POST['txtPhoneNumber']);
            $this->modeloC->__SET('direccion', $_POST['txtAddress']);
            $this->modeloC->__SET('email', $_POST['txtEmail']);
            $this->modeloC->__SET('genero', $_POST['selGenere']);

       
        //vamos a crear una variable que llamará al método del modelo para poder registrar los datos
        $person = $this->modeloC->registrarPersonas();

        //validamos que registre desde la último rol registrado
        if($person == true){
            $ultimoId = $this->modeloC->ultimoIdPersona();
            //foreach que se encarga de tomar los datos explicitos
            foreach($ultimoId as $value){
                $ultimoIdValue = $value['ultimoIdPersona'];
            }
        }

            $this->modeloC->__SET('idPersona', $ultimoIdValue);
            $this->modeloC->__SET('idTipoCliente', $_POST['selCleType']);
            // $this->modeloC->__SET('Estado', $_POST['txtPassword']);
            

            $client = $this->modeloC->ClientRegister();
            // var_dump($client);
            // exit;

        //aquí vamos a estilizar con la librería sweetalert2
         if($person == true && $client == true){
             $_SESSION["alert"] = "Swal.fire({
                 position:'',
                 icon: 'success',
                 title: 'Done',
                 showConfirmButton: false,
                 timer: 1500})";

                 header("Location: " .URL."clientController/clientRegister");
                 exit();
         }else{
             $_SESSION["alert"] = "Swal.fire({
                 position:'',
                 icon: 'error',
                 title: 'Error',
                 showConfirmButton: false,
                 timer: 3000})";

                 header("Location: " .URL."clientController/clientRegister");
                 exit();
             }
        }

        if(isset($_POST['btnUpdateClient'])){
            //comunicación modelo y formulario
        //    $this->modeloC->__SET('Descripcion', $_POST['txtDescripcion']);
            $this->modeloC->__SET('idTipoDocumento', $_POST['selDocTypeEdit']);
            $this->modeloC->__SET('documento', $_POST['txtDocumentEdit']);
            $this->modeloC->__SET('nombre', $_POST['txtNamesEdit']);
            $this->modeloC->__SET('apellidos', $_POST['txtLastNameEdit']);
            $this->modeloC->__SET('telefono', $_POST['txtPhoneNumberEdit']);
            $this->modeloC->__SET('email', $_POST['txtEmailEdit']);
            $this->modeloC->__SET('descripcion', $_POST['selCleTypeEdit']); //hice esta hora 7:17 pm
            $this->modeloC->__SET('idCliente', $_POST['txtIdClientEdit']);
            //  var_dump($_POST['selDocTypeEdit'],$_POST['txtDocumentEdit'],$_POST['txtNamesEdit'],$_POST['txtLastNameEdit'],$_POST['txtPhoneNumberEdit'],$_POST['txtEmailEdit'],$_POST['selCleTypeEdit'],$_POST['txtIdClientEdit']);
            //  exit();
           //variable para el actualizar
           $updateClient = $this->modeloC->updateClient();
            //  var_dump($updateClient);
            //  exit;
    
           //sweetalert
            if($updateClient==true){
            
                $_SESSION['alert'] = "Swal.fire({
                    position:'',
                    icon: 'success',
                    title: 'Done',
                    showConfirmButton: false,
                    timer: 1500})";
    
                    header("Location: " .URL."clientController/clientRegister");
                    exit();
            }else{
                $_SESSION["alert"] = "Swal.fire({
                    position:'',
                    icon: 'error',
                    title: 'Error',
                    showConfirmButton: false,
                    timer: 3000})";
    
                    header("Location: " .URL."clientController/clientRegister");
                    exit();
                 }
           
            }
    
            //variables para traer los demás métodos necesarios
            $client = $this->modeloC->getClients();
            $typeClient = $this->modeloC->getTypeClient();
            $tipoDocumentos = $this->modeloU->listarTipoDocumento();
    
            require APP . 'view/_templates/header.php';
            require APP . 'view/clientes/getClients.php';
            require APP . 'view/_templates/footer.php';
  
    }


   

    //función para traer el ID del modelo
    public function dataClient(){
        //crear una variable para controlar el dato
        $dataClient = $this->modeloC->clienteId($_POST['id']);
        echo json_encode($dataClient);
    }
    
    public function changeStatusClient(){
        //crear una variable para controlar el dato
        $dataClient = $this->modeloC->changeStatusClient($_POST['id']);
        echo 1;
    }

    public function deleteClient(){
        $dataClient = $this->modeloC->deleteClient($_POST['id']);
        echo 1;
    }

}

?>