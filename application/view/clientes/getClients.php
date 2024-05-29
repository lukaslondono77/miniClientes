<div class="col-md-24 col-sm-24  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>CLIENTS<small></small></h2>
                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-addClient"><i class="fa fa-plus-square"></i></button>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                          <th>Document</th>
                          <th>Type</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Phone Number</th>
                          <th>Email</th>
                          <th>Type Client</th>
                          <th>Status</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($client as $value):?>
                        <tr>
                          <th scope="row"><?php echo $value['idCliente'];?></th>
                          <td><?php echo $value['Documento'];?></td>
                          <td><?php echo $value['Descripcion'];?></td>
                          <td><?php echo $value['Nombre'];?></td>
                          <td><?php echo $value['Apellidos'];?></td>
                          <td><?php echo $value['Telefono'];?></td>
                          <td><?php echo $value['Email'];?></td>
                          <td><?php echo $value['TipoCliente'];?></td>

                          <td>
                            <?php if($value['Estado'] == 1):?>
                                <label class="badge badge-pill badge-success">Activo</label>
                            <?php else: ?>
                                <label class="badge badge-pill badge-danger">Inactivo</label> 
                            <?php endif;?>      
                          </td>
                          <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit" title="Edit" onclick="dataClient('<?php echo $value['idCliente'];?>')"><i class="fa fa-edit"></i></button>

                            <button type="button" class="btn btn-warning btn-xs" onclick="changeStatusClient('<?php echo $value['idCliente'];?>')"><i class="fa fa-refresh"></i></button>

                            <button type="button" class="btn btn-danger btn-xs" onclick="deleteClient('<?php echo $value['idCliente'];?>')"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <!-- modal -->
        <div class="modal fade bs-example-modal-lg"  id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">UPDATE CLIENTS</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                        </div>
                    <div class="modal-body">
                        <form method="post">
                            <input type="text" name="txtIdClientEdit" id="txtIdClientEdit">
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Type Document</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="selDocTypeEdit" id="selDocTypeEdit">
                                  <option>Choose option</option>
                                  <?php foreach($tipoDocumentos as $value):?>
                                      <option value="<?php echo $value['idTipoDocumento'];?>"><?php echo $value['doc'];?></option>
                                  <?php endforeach;?>    
                                </select>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Document">Document<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="txtDocumentEdit" required="required" class="form-control" name="txtDocumentEdit">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="txtNamesEdit" required="required" class="form-control" name="txtNamesEdit">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="txtLastNameEdit" name="txtLastNameEdit" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="Phone Number" class="col-form-label col-md-3 col-sm-3 label-align">Phone Number</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="txtPhoneNumberEdit" class="form-control" type="number" name="txtPhoneNumberEdit" required="required">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="Email" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="txtEmailEdit" class="form-control" type="email" name="txtEmailEdit" required="required">
                              </div>
                            </div>

                            
                                  <!-- acabe de hacer este 8.18 pm -->
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Type Client</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="selCleTypeEdit" id="selCleTypeEdit">
                                  <option>Choose option</option>
                                  <?php foreach($typeClient as $value):?>
                                      <option value="<?php echo $value['idTipoCliente'];?>"><?php echo $value['descripcion'];?></option>
                                  <?php endforeach;?>    
                                </select>
                              </div>
                            </div>
                            
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnUpdateClient">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    <div class="modal fade bs-example-modal-lg"  id="modal-addClient" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ADD CLIENT</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                        <form method="post">
                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Type Document</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="selDocType" id="selDocType">
                                  <option>Choose option</option>
                                  <?php foreach($tipoDocumentos as $value):?>
                                      <option value="<?php echo $value['idTipoDocumento'];?>"><?php echo $value['doc'];?></option>
                                  <?php endforeach;?>    
                                </select>
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="Document">Document<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="txtDocument" required="required" class="form-control" name="txtDocument">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="txtNames" required="required" class="form-control" name="txtNames">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="txtLastName" name="txtLastName" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="Phone Number" class="col-form-label col-md-3 col-sm-3 label-align">Phone Number</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="txtPhoneNumber" class="form-control" type="number" name="txtPhoneNumber" required="required">
                              </div>
                            </div>

                            <div class="item form-group">
							    <label for="Address" class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
							    <div class="col-md-6 col-sm-6 ">
								    <input id="txtAddress" class="form-control" type="text" name="txtAddress" required="required">
							    </div>
							</div>

                            <div class="item form-group">
                              <label for="Email" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="txtEmail" class="form-control" type="email" name="txtEmail" required="required">
                              </div>
                            </div>

                            <div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
								<div class="col-md-6 col-sm-6 ">
									<div id="selGenere" class="btn-group" data-toggle="buttons">
										<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="selGenere" value="male" class="join-btn"> &nbsp; Male &nbsp;
										</label>
										<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="selGenere" value="female" class="join-btn"> Female
										</label>
									</div>
								</div>
							</div>


                            <div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input id="txtBirthdate" name="txtBirthdate" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
									<script>
										function timeFunctionLong(input) {
											setTimeout(function() {
												input.type = 'text';
											}, 60000);
										}
									</script>
								</div>
							</div>
                            

                            <div class="form-group row">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Type Client</label>
                              <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="selCleType" id="selCleType">
                                  <option>Choose option</option>
                                  <?php foreach($typeClient as $value):?>
                                      <option value="<?php echo $value['idTipoCliente'];?>"><?php echo $value['descripcion'];?></option>
                                  <?php endforeach;?>    
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