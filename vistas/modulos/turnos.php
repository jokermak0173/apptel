<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar turnos
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar turnos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCapacitador" id="btnAgregarUsuario"> 
            Agregar turno
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>Horario Entrada</th>
                        <th>Horario Salida</th>                    
                          
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item1 = "plaza";
                    $valor1 = $_SESSION["idPlaza"];
                    
                    
                    $turnos = ControladorTurnos::ctrMostrarTurnos();

                    foreach($turnos as $key => $value){

                      
                      echo '<tr> 
                                <td>'.$value["horario_entrada"].'</td>
                                <td>'.$value["horario_salida"].'</td>';
                               
                                
                                
                               
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
=             MODAL AGREGAR TURNO      =
=============================================-->
<div id="modalAgregarCapacitador" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar turno</h4>
        </div>
         <div class="modal-body">
            <div class="box-body"> 

              <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group clockpicker">
                      <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                      <input type="text" class="form-control input-lg" name="nuevaHoraEntrada" placeholder="Horario Entrada" required >
                    </div>
                   </div>
                </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group clockpicker">
                      <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                      <input type="text" class="form-control input-lg" name="nuevaHoraSalida" placeholder="Horario Salida" required>
                    </div>
                   </div>
                 </div>
                 
               </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Guardar Turno</button>
          </div>
           <?php

            $crearCapacitador = new ControladorTurnos();
            $crearCapacitador->ctrAgregarTurno();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR CAPACITADOR  ====-->
