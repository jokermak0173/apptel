   
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Recomienda
      </h1>

      <ol class="breadcrumb">
        <li><a href="permutasAdministrativo"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Recomienda</li>
      </ol>
    </section>
    <section class="content">
      <!-- Default box -->

    <div class="box">

        <div class="box-header with-border">
           <button class="btn btn-success" data-toggle="modal" data-target="#modalReporteRecomendados" id="btnDescargarReporteRecomendados"> 
            Descargar reporte CSV <i class="fa fa-download"></i>
           </button>
            <center><h4><b>Recomendados &nbsp;&nbsp;&nbsp; <?php echo $_SESSION["nombrePlaza"];?></b></h4></center> 
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr> 
                        <th>Nombre recomendado</th> 
                        <th>Tel / Cel</th>
                        <th>#Emp recomienda</th>                    
                        <th>Nombre recomienda</th>
                        <th>Supervisor recomienda</th>
                        <th>Fecha recomendacion</th>
                        <th>Acciones</th>
                        
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item = "plaza";
                    $valor = $_SESSION["idPlaza"];
                    $item2 = "estado";
                    $valor2 = 0;
                    $recomendados = ControladorRecomendados::ctrMostrarRecomendadosPlaza($item, $valor, $item2, $valor2);
                    
                    foreach($recomendados as $key => $value){
                        $item = "id";
                        $valor = $value["supervisor"];
                        $supervisor = ControladorSupervisores::ctrMostrarSupervisor($item, $valor);
                        $nombre_supervisor = utf8_decode($supervisor["nombre"])." ".utf8_decode($supervisor["apellido_paterno"])." ".utf8_decode($supervisor["apellido_materno"]);
                      echo '<tr> 
                                <td>'.$value["nombre_recomendado"].'</td>
                                <td>'.$value["tel_recomendado"].'</td>
                                <td>'.$value["numemp"].'</td>
                                <td>'.utf8_decode($value["nombre_completo"]).'</td>
                                <td>'.$nombre_supervisor.'</td>
                                <td>'.$value["fecha_creacion"].'</td>
                                <td><button class="btn btn-info btnInfoRecomendado"  data-toggle="modal" data-target="#modalCalificarRecomendado" idRecomendado="'.$value["id"].'" reviso="'.$_SESSION["numemp"].'"><i class="fa fa-comment-alt"></i></button></td>';
                                
                                
                               
                                 echo'</tr>';

                  
                            
                     }             
                  ?>
                    
                    
                </tbody>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>
    </section>
  </div>



<!--============================================
=             MODAL CALIFICAR RECOMENDADO          =
=============================================-->
<div id="modalCalificarRecomendado" class="modal fade" role="dialog">
  <div class="modal-dialog">
   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#52A9E4; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Calificar Recomendado</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

               
              
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-child"></i></span>
                  <input type="text" class="form-control input-lg" id="nombreRecomendado" name="nombreRecomendado" >
                  <input type="hidden" id="idRecomendado" name="idRecomendado" >
                </div>
              </div>
          
              

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><i class="fas fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="telRecomendado" name="telRecomendado" required readonly>
                </div>
              </div>

               <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><i class="fas fa-comment"></i></span>
                  <input type="text" class="form-control input-lg" id="comentarioContacto" name="comentarioContacto" required readonly>
                </div>
              </div>

             
              <center><h5>Escrbe una nota sobre el recomendado</h5></center>
              <textarea class="form-control" name="comentarioRevision" id="comentarioRevision" cols="75" rows="5"></textarea>
              <br>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><i class="fas fa-edit"></i></span>
                  <select class="form-control input-lg" name="calificacionRecomendado" id="calificacionRecomendado"  required>
                    <option value="">Califica el recomendado</option> 
                      <option value="1">No se pudo contactar</option>
                      <option value="2">Numero equivocado</option>
                      <option value="3">No interesado</option>
                      <option value="9">Citado a entrevista</option>
                  </select>
                </div>
              </div>
               
             

            
              

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-info">Guardar cambios</button>
          </div>
       <?php

       		$calificarRecomendado = new ControladorRecomendados();
            $calificarRecomendado->ctrCalificarRecomendado();

       ?>
      </form>
  </div>
</div>
</div>  

<div id="modalReporteRecomendados" class="modal fade" role="dialog">
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

          $descargarRecomendados = new ControladorRecomendados();
          $descargarRecomendados->ctrDescargarReporte();

        ?>
      </form>

  </div>
</div>
</div>