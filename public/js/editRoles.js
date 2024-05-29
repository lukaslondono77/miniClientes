//crear el método para dato del rol
function dataRoles(id){
    // alert(id);
    $.ajax({
        url: url + "rolesController/dataRoles",
        type: "post",
        dataType: "json",
        data:{'id':id}
    }).done(function(answer){
        $.each(answer, function(index, value){
            $('#txtIdRol').val(value.idRol);
            $('#txtDescripcion').val(value.Descripcion);
           
        })
    }).fail(function(error){
        console.log(error)
    })
}

//método para cambiar el estado
function changeStatusRole(id){
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
                        url: url + "rolesController/changeStatusRole",
                        data:{'id':id,}
                    }).done(function(answer){
                        if(answer == 1){
                            window.location = url + "rolesController/roleREgister";
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



function deleteRole(id){
    // alert(id);
    Swal.fire({
        title:'Would you like to delete this role?',
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
                        url: url + "rolesController/deleteRole",
                        data:{'id':id,}
                    }).done(function(answer){
                        if(answer == 1){
                            window.location = url + "rolesController/roleREgister";
                            window.reload();
                        }else{
                            Swal.fire('Wrong to Delete Role', '', 'error');
                        }
                    }).fail(function(error){
                        console.log(error);
                    })
                }
            })
        }
    })
}