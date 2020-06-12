
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

          <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Recomienda a tus amigos y gana $$$</h4></center>
        </div>
         <div class="modal-body">
            <div class="box-body">



              <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>Nombre</b></span>
                     <input type="text" class="form-control input-lg" name="nombreRecomendado" id="nombreRecomendado" required>

                    </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>Tel / Cel</b></span>
                      <input type="number" class="form-control input-lg " name="telRecomendado" id="telRecomendado"  required>

                    </div>
                   </div>
                 </div>
               </div>

               <center><h5>Escribe un comentario, hora de contacto o cualquier otra informacion para poder contactar al recomendado *opcional</h5></center>
              <textarea class="form-control" name="comentarioContacto" id="comentarioContacto" cols="75" rows="5"></textarea>


            </div>
          </div>
          <div class="modal-footer">
            <center>
            <?php
               echo
                          '<button type="button" class="btn btn-success btnRecomendar" numEmp="'.$_SESSION["numemp"].'">Recomendar</button>';

            ?>
          </center>
          </div>

      </form>






        </div>
      </div>
            <div class="box">
        <div class="box-header with-border">
            <center><h3>Mis recomendados</h3></center>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tel / Cel</th>
                        <th>Fecha Recomendacion</th>
                        <th>Estado</th>
                        <th>Comentario Reclutador</th>

                    </tr>
                </thead>
                <tbody>
                  <?php
                    $item = "numemp_recomienda";
                    $valor = $_SESSION["numemp"];
                    $recomendados = ControladorRecomendados::ctrMostrarRecomendados($item, $valor);

                    foreach($recomendados as $key => $value){

                     switch ($value["estado"]) {
                       case 0: $estado = "enviado"; $claseBoton = "default"; break;
                       case 1: $estado = "No se pudo contactar"; $claseBoton = "danger"; break;
                       case 2: $estado = "Numero equivocado"; $claseBoton = "danger"; break;
                       case 3: $estado = "No interesado"; $claseBoton = "danger"; break;
                       case 9: $estado = "Citado a entrevista"; $claseBoton = "warning";break;
                       case 11: $estado = "No se presento"; $claseBoton = "danger";break;
                       case 12: $estado  = "Rechazado"; $claseBoton = "danger";break;
                       case 13: $estado = "Reingreso"; $claseBoton = "danger";break;
                       case 14: $estado = "Pendiente"; $claseBoton = "warning";break;
                       case 19: $estado = "Citado a curso"; $claseBoton = "info";break;
                       case 21: $estado = "No acudio a curso"; $claseBoton = "info";break;
                       case 29: $estado = "En curso"; $claseBoton = "info";break;
                       case 31: $estado = "Depurado"; $claseBoton = "danger";break;
                       case 32: $estado = "No le gusto"; $claseBoton = "danger";break;
                       case 33: $estado = "Abandono"; $claseBoton = "danger";break;
                       case 39: $estado = "Certifico"; $claseBoton = "primary";break;
                       case 41: $estado = "Baja"; $claseBoton = "danger";break;
                       case 49: $estado = "Bono Pagado"; $claseBoton = "success";break;

                       default:

                         break;
                     }
                      echo '<tr>
                                <td>'.$value["nombre_recomendado"].'</td>
                                <td>'.$value["tel_recomendado"].'</td>
                                 <td>'.$value["fecha_creacion"].'</td>';
                                 echo'<td><button class="btn btn-'.$claseBoton.' btn-xs">'.$estado.'</button></td>';
                                 echo '<td>'.$value["comentario_revision"].'</td></tr>';



                     }
                  ?>


                </tbody>
          </table>
        </div>
        <!-- /.box-body -->

      </div>
    </section>
  </div>
