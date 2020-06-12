
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario" id="btnAgregarUsuario"> 
            Agregar usuario
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>Num. Emp.</th>
                       
                        <th>Nombre</th>
                        <th>Nivel</th>
                        <th>Plaza</th>
                      
                       
                        
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                  <?php 
                   
                    $item1 = "status_usuario";
                    $valor1 = "1";
                  
                    
                    $usuarios = ControladorUsuarios::ctrMostrarUsuariosRoot($item1, $valor1);
                    
                    foreach($usuarios as $key => $value){

                      $plazaAsesor = ControladorPlazas::ctrMostrarPlaza("id", $value["plaza"]);
                      $nivelUsuario = ControladorNiveles::ctrMostrarNivel("id", $value["nivel_acceso"]);
                      echo '<tr> 
                                <td>'.$value["numemp"].'</td>
                               
                                <td>'.utf8_decode($value["nombre_completo"]).'</td>
                                <td>'.$nivelUsuario["descripcion"].'</td>                               
                                <td>'.$plazaAsesor["nombre"].'</td>';
                              
                                
                                
                                if($value["status_usuario"] != 0){
                                  echo '<td><button class="btn btn-primary btn-xs btnActivar" idAsesor="'.$value["numemp"].'" statusAsesor="0">Activado</button></td>';
                                }else{
                                  echo ' <td><button class="btn btn-danger btn-xs btnActivar" idAsesor="'.$value["numemp"].'" statusAsesor="1">Deshabilitado</button></td>';
                                } 
                               
                                 echo'
                                <td>  
                                  <div class="btn-group"> 
                                    <button class="btn btn-warning btnEditarUsuarioRoot" data-toggle="modal" data-target="#modalEditarUsuarioSistemas" idAsesor="'.$value["numemp"].'" ><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-info btnLiberarUsuarioRoot" idUsuario="'.$value["numemp"].'" ><i class="fa fa-level-up-alt"></i></button>
                                    
                                  </div>
                                </td>
                            </tr>';
                            
                    }

                  ?>
                   
                    </tr>
                </tbody>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>


    </section>
   
  </div>

<!--============================================
=             MODAL AGREGAR ASESOR          =
=============================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>#</b></span>
                      <input type="text" class="form-control input-lg nuevoNumEmpleado" name="nuevoNumeroEmpleadoRoot" placeholder="Num. Empleado" id="nuevoNumEmpleado" required>

                    </div>
                   </div>
                 </div>
                  <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" ><i class="fas fa-fingerprint"></i></span>
                      <?php
                        echo ' <input type="text" class="form-control input-lg" name="nuevoIdChecadorRoot" id="nuevoIdChecador" plaza="'.$_SESSION["idPlaza"].'" placeholder="ID. Checador" required>';
                      ?>
                     
                    </div>
                   </div>
                 </div>
               </div>
              

              
          
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombreSistemas" placeholder="Nombre Completo" required>
                </div>
              </div>
            
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                  <select class="form-control input-lg" name="nuevaPlazaRoot" required>
                      <option value="">Plaza</option>
                      <?php
                        $plazas = ControladorPlazas::mostrarPlazasActivas();
                        foreach ($plazas as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }
                      ?>
                      
                  </select>
                </div>
              </div>
  
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                  <select class="form-control input-lg" name="nuevoNivelSistemas"   required>
                      <option value="">Nivel</option>
                      <option value="1">Sistemas</option>
                      <option value="2">Calidad / Supervisor</option>
                      <option value="3">Recrea</option>
                      <option value="4">Administrativo</option> 
                      <option value="6">Reclutamiento y Seleccion</option> 
                      <option value="7">Director</option>
                     
                      
                  </select>
                </div>
              </div>

              <div class="form-group">
               
                  <div class="panel">SUBIR FOTO</div>
                  <input type="file" class="nuevaFoto" name="nuevaFoto">
                  <p class="help-block">Peso maximo de la foto 200 MB</p>
                  <img src="vistas/img/asesores/anonymous.png" class="img-thumbnail previsualizar" width="100px" id="imgNuevaFoto">
                
              </div>
             

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Guardar usuario</button>
          </div>
           <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario->ctrRegistrarUsuarioRoot();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR ASESOR  ====-->

<!--============================================
=             MODAL EDITAR USUARIO          =
=============================================-->
<div id="modalEditarUsuarioSistemas" class="modal fade" role="dialog">
  <div class="modal-dialog">
   
    <div class="modal-content">
      <form role="form" method="post" >
        <div class="modal-header" style="background:#FBB000; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>#</b></span>
                      <input type="text" class="form-control input-lg" id="editarNumeroEmpleadoRoot" name="editarNumeroEmpleadoRoot" placeholder="Num. Empleado" readonly>

                    </div>
                   </div>
                 </div>
               </div>
              
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="editarPasswordRoot" placeholder="Reset Password" >
                  <input type="hidden" id="passwordActualRoot" name="passwordActualRoot" >
                </div>
              </div>
          
              

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" id="editarNombreRoot" name="editarNombreRoot" placeholder="Nombre Completo" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                  <select class="form-control input-lg" name="editarNivelRoot"  id="editarNivelRoot" required>
                      
                  </select>
                </div>
              </div>

               <div class="form-group">
               
                  <div class="panel">SUBIR FOTO</div>
                 
                  <input type="file"  class="nuevaFoto" name="editarFoto">
                  <p class="help-block">Peso maximo de la foto 200 MB</p>
                  <img src="" class="img-thumbnail previsualizar" width="100px">
                  <input type="hidden" name="fotoActual" id="fotoActual">
              </div>


          </div>
        </div> 
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-warning">Editar usuario</button>
          </div>
          <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario->ctrEditarUsuarioRoot();

        ?>
      </form>
  </div>
</div>
</div>  
<!--====  End of  MODAL EDITAR ASESOR  ====-->
