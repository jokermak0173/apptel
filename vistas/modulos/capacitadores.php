<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar capacitadores
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar capacitadores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCapacitador" id="btnAgregarUsuario"> 
            Agregar capcitador
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>                    
                        <th>Nombre</th>  
                         <th>Estado</th>  
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item1 = "plaza";
                    $valor1 = $_SESSION["idPlaza"];
                    $item2 = null;
                    $valor2 = null;
                    
                    $capacitadores = ControladorCapacitadores::ctrMostrarCapacitadores($item1, $valor1, $item2, $valor2);

                    foreach($capacitadores as $key => $value){

                      
                      echo '<tr> 
                                <td>'.utf8_decode($value["apellido_paterno"]).'</td>
                                <td>'.utf8_decode($value["apellido_materno"]).'</td>
                                <td>'.utf8_decode($value["nombre"]).'</td>';
                                
                                
                                if($value["estado"] != 0){
                                  echo '<td><button class="btn btn-primary btn-xs btnActivarCapacitador" idCapa="'.$value["id"].'" statusCapa="0">Activo</button></td>';
                                }else{
                                  echo ' <td><button class="btn btn-danger btn-xs btnActivarCapacitador" idCapa="'.$value["id"].'" statusCapa="1">inactivo</button></td>';
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
=             MODAL AGREGAR CAPACITADOR        =
=============================================-->
<div id="modalAgregarCapacitador" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar capacitador</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NOMBRE DEL CAPACITADOR -->

                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="nuevoCapa" placeholder="Nombre" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="paternoCapa" placeholder="Apellido Paterno" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="maternoCapa" placeholder="Apellido Materno" required>
                </div>
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Guardar capacitador</button>
          </div>
           <?php

            $crearCapacitador = new ControladorCapacitadores();
            $crearCapacitador->ctrAgregarCapacitador();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR CAPACITADOR  ====-->
