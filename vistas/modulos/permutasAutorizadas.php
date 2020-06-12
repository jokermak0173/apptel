<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar permutas autorizadas - 
      </h1>

      <ol class="breadcrumb">
        <li><a href="permutasAdministrativo"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar permutas autorizadas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
         
         
        </div>
        <div class="box-body">
       
          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>
                        <th>Fecha Permuta</th>
                        <th>Tipo permuta</th>  
                       
                        <th> Solicita</th>
                       
                        <th> Acepta</th>
                        
                        
                        
                          
                          <th>Campaña</th>
                          <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item1 = "fecha_solicita";
                    $valor1 = date('Y-m-d');
                     $item2 = "plaza";
                    $valor2 = $_SESSION["idPlaza"];
                     $item3 = "estado";
                    $valor3 = "autorizada";
                     $item4 = "estado";
                    $valor4 = "cancelada";
                   
                    $permutas = ControladorPermutas::ctrMostrarPermutas($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
                    
                    foreach($permutas as $key => $value){

                      $asesorSolicita = ControladorUsuarios::ctrMostrarAsesorPorId("numemp", $value["asesor_solicita"]);
                      $asesorAcepta = ControladorUsuarios::ctrMostrarAsesorPorId("numemp", $value["asesor_acepta"]);
                      
                      $campaña = ControladorCampañas::ctrMostrarCampaña("id", $value["campana_solicita"]);
                      $turnoSolicita = ControladorTurnos::ctrMostrarTurno("id", $asesorSolicita["turno"]);
                      $turnoAcepta = ControladorTurnos::ctrMostrarTurno("id", $asesorAcepta["turno"]);
                      echo '<tr> 
                                <td>'.$value["fecha_solicita"].'</td>';
                                switch($value["tipo_permuta"])
                                {
                                  case 1: $tipo_permuta = "Permuta dia x dia"; break;
                                  case 2: $tipo_permuta = "Permuta libre"; break;
                                  case 3: $tipo_permuta = "Cambio Turno"; break;
                                }
                      echo '
                                <td>'.$tipo_permuta.'</td>
                              
                                <td>'.utf8_decode($asesorSolicita["nombre_completo"]).'</td>
                                
                                <td>'.utf8_decode($asesorAcepta["nombre_completo"]).'</td>
                               
                               
                                
                                <td>'.$campaña["campana"].'</td>';
                                
                                $turnoS = $turnoSolicita["horario_entrada"]." - ".$turnoSolicita["horario_salida"];
                                $turnoA = $turnoAcepta["horario_entrada"]." - ".$turnoAcepta["horario_salida"];

                                echo ' <td>'.$value["estado"].'</td>';
                               
                               
                                 echo'
                                <td>  
                                  <div class="btn-group">
                             
                                    <button class="btn btnCancelarPermuta" idPermuta="'.$value["id"].'" reviso="'.$_SESSION["numemp"].'"><i class="fa fa-times"></i></button>
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

<div id="modalReportePermutas" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Descargar reporte</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">



              <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>Inicio</b></span>
                     <input type="date" class="form-control input-lg" name="fechaInicio" required>

                    </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>Fin</b></span>
                      <input type="date" class="form-control input-lg " name="fechaFin" required>

                    </div>
                   </div>
                 </div>
               </div>

         


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Descargar</button>
          </div>
           <?php

            $descargarArchivo = new ControladorPermutas();
            $descargarArchivo->ctrDescargarReporte();

          ?>
      </form>

  </div>
</div>
</div>