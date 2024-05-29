//crear el método para dato del rol
function dataClient(id){
    alert(id);
    $.ajax({
        url: url + "clientController/dataClient",
        type: "post",
        dataType: "json",
        data:{'id':id}
    }).done(function(answer){
        $.each(answer, function(index, value){
            $('#selDocTypeEdit').val(value.idTipoDocumento);
            $('#txtDocumentEdit').val(value.Documento);
            $('#txtNamesEdit').val(value.Nombre);
            $('#txtLastNameEdit').val(value.Apellidos);
            $('#txtPhoneNumberEdit').val(value.Telefono);
            $('#txtEmailEdit').val(value.Email);
            $('#selCleTypeEdit').val(value.idTipoCliente); 
            $('#txtIdClientEdit').val(value.idCliente);
           
        })
    }).fail(function(error){
        console.log(error)
    })
}

//método para cambiar el estado
function changeStatusClient(id){
    // alert(id);
    Swal.fire({
        title:'Would you like to change status?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it',
    }).then((result)=>{
        if(result.isConfirmed){
            Swal.fire({
                position: "",
                icon: "success",
                title: "Status changed",
                confirmButtonText: "OK",
                timer: 1500
            }).then((result)=>{
                if(result.isConfirmed){
                    $.ajax({
                        type: "post",
                        url: url + "clientController/changeStatusClient",
                        data:{'id':id,}
                    }).done(function(answer){
                        if(answer == 1){
                            window.location = url + "clientController/clientRegister";
                            window.reload();
                        }else{
                            Swal.fire('Wrong to change Status', '', 'error');
                        }
                    }).fail(function(error){
                        console.log(error);
                    })
                }
            })
        }
    })
}



function deleteClient(id){
    // alert(id);
    Swal.fire({
        title:'Would you like to delete this Client?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it',
    }).then((result)=>{
        if(result.isConfirmed){
            Swal.fire({
                position: "",
                icon: "success",
                title: "Role Deleted",
                confirmButtonText: "OK",
                timer: 1500
            }).then((result)=>{
                if(result.isConfirmed){
                    $.ajax({
                        type: "post",
                        url: url + "clientController/deleteClient",
                        data:{'id':id,}
                    }).done(function(answer){
                        if(answer == 1){
                            window.location = url + "clientController/clientRegister";
                            window.reload();
                        }else{
                            Swal.fire('Wrong to Delete Client', '', 'error');
                        }
                    }).fail(function(error){
                        console.log(error);
                    })
                }
            })
        }
    })
}