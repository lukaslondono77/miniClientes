<div class="col-md-12 col-sm-12  ">
  <div class="x_panel">
    <div class="x_title">
      <h2>New Rol <small></small></h2>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-addRol" onclick="changeStatusRole('<?php echo $value['idRol']; ?>')"><i class="fa fa-plus-square"></i></button>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
              class="fa fa-wrench"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Settings 1</a>
            <a class="dropdown-item" href="#">Settings 2</a>
          </div>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Rol</th>
            <th>Status</th>
            <th>Functions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($roles as $value): ?>

            <tr>
              <th scope="row"><?php echo $value['idRol'] ?></th>
              <td><?php echo $value['Descripcion'] ?></td>              
              <td>
                <?php if ($value['Estado'] == 1): ?>
                  <label class="badge badge-pill badge-success">Activo</label>
                <?php else: ?>
                  <label class="badge badge-pill badge-danger">Inactivo</label>
                <?php endif; ?>
              </td>
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit" title="Edit" onclick="dataRoles('<?php echo $value['idRol']; ?>')"><i class="fa fa-edit"></i>
                </button>

                <button type="button" class="btn btn-warning btn-xs" onclick="changeStatusRole('<?php echo $value['idRol']; ?>')"><i class="fa fa-refresh"></i>
                </button>

                <button type="button" class="btn btn-danger btn-xs" onclick="deleteRole('<?php echo $value['idRol']; ?>')"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>

    </div>
  </div>
</div>



<div class="modal fade bs-example-modal-lg"  id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">UPDATE ROLE</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                        <form method="post">
                            <input type="hidden" name="txtIdRol" id="txtIdRol">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="Document">Rol<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="txtDescripcion" required="required" class="form-control" name="txtDescripcion">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
                                </div>
                        </form>
                    </div>
            </div>
        </div>
</div>

<div class="modal fade bs-example-modal-lg"  id="modal-addRol" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ADD ROLE</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                        <form method="post">
                            <input type="hidden" name="txtIdRol" id="txtIdRol">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Role Name<span class="required">*<span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="txtDescripcion" required="required" class="form-control" name="txtDescripcion">
                                    </div>  
                                </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Status<span class="required">*<span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" name="selStatus" id="selStatus">
                                                <option selected="selected" value="">select Status</option>
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>  
                                            </select>
                                        </div>
                                    </div>
                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnRegister">ADD</button>
                                </div>
                        </form>
                    </div>
            </div>
        </div>
</div>