<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar supervisores
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar supervisores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario" id="btnAgregarUsuario"> 
            Agregar supervisores
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>ID SUPER</th>  
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>                    
                        <th>Nombre</th>  
                        <th>Campaña</th>
                        
                        <th>Estado</th>  
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item1 = "plaza";
                    $valor1 = $_SESSION["idPlaza"];
                    $item2 = null;
                    $valor2 = null;
                    $item3 = null;
                    $valor3 = null;
                    $supervisores = ControladorSupervisores::ctrMostrarSupervisores($item1, $valor1, $item2, $valor2, $item3, $valor3);

                    foreach($supervisores as $key => $value){

                      $item1 = "id";
                      $valor1 = $value["campana"];
                      $campañaDelSupervisor = ControladorCampañas::ctrMostrarCampaña($item1, $valor1);
                      echo '<tr> 
                                <td>'.utf8_decode($value["id"]).'</td>
                                <td>'.utf8_decode($value["apellido_paterno"]).'</td>
                                <td>'.utf8_decode($value["apellido_materno"]).'</td>
                                <td>'.utf8_decode($value["nombre"]).'</td>
                                <td>'.utf8_decode($campañaDelSupervisor["campana"]).'</td>';
                                
                                if($value["estado"] != 0){
                                  echo '<td><button class="btn btn-primary btn-xs btnActivarSupervisor" idSuper="'.$value["id"].'" statusSuper="0">Activo</button></td>';
                                }else{
                                  echo ' <td><button class="btn btn-danger btn-xs btnActivarSupervisor" idsuper="'.$value["id"].'" statusSuper="1">inactivo</button></td>';
                                } 
                               
                                 echo'
                                
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
=             MODAL AGREGAR SUPERVISOR        =
=============================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar supervisor</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NOMBRE DEL SUPERVISOR -->

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="nuevoSuper" placeholder="Nombre" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="paternoSuper" placeholder="Apellido Paterno" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="maternoSuper" placeholder="Apellido Materno" required>
                </div>
              </div>

               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" ><i class="fa fa-campground"></i></span>
                
                      <select name="nuevaCampana" class="form-control input-lg" required>
                    
                        <option value="">Seleccionar Campaña</option>
                           <?php

                              $campañasAsociadas = ControladorCampañas::ctrMostrarCampañasPlaza("plaza", $_SESSION["idPlaza"], "activo", "1");

                              foreach($campañasAsociadas as $key => $value)
                              {
                                
                                echo '<option value="'.$value["id"].'">'.$value["campana"].'</option>';
                              }
                              
                           
                          ?>

                    </select>
                </div>
              </div>
              

              
          
              
             

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Guardar supervisor</button>
          </div>
           <?php

            $crearCampaña = new ControladorSupervisores();
            $crearCampaña->ctrAgregarSupervisor();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR ASESOR  ====-->
