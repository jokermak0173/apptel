

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Checador
        <small>Subir Base</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Checador</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSubirBaseChecador">Subir Base Checador &nbsp;&nbsp;<i class="fa fa-upload" ></i></button>
            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAnularBaseChecador">Anular Base Checador &nbsp;&nbsp;<i class="fa fa-times" ></i></button>-->
             &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSubirBaseAsistencias">Subir Base Control Asistencias &nbsp;&nbsp;<i class="fa fa-upload" ></i></button>
            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAnularBaseAsistencias">Anular Base Control Asistencias &nbsp;&nbsp;<i class="fa fa-times" ></i></button> -->
          </h3>


          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         <?php
             $item = "usuario_subio";
             $valor = $_SESSION["numemp"];
             $respuesta = ControladorHorarios::ctrBuscarUltimaFecha($item, $valor);
         ?>
         Ultima fecha subida : <?php echo "<b>".$respuesta["fecha"]."</b>"; ?>
      
        <!-- /.box-footer
      </div> -->
      <!-- /.box -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--============================================
=             MODAL SUBIR BASE CHECADOR        =
=============================================-->
<div id="modalSubirBaseChecador" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Subir Base&nbsp;&nbsp;<i class="fa fa-upload" ></i></h4>
        </div>
         <div class="modal-body">
            <div class="box-body">
          
              <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon" style="font-size: 16px"><b>1 - El archivo debe tener la siguiente estructura</b></span>
                </div>
              </div>

            
              <div class="form-group">
                <div class="input-group">
                  <i> - Fijarse en el formato de la Fecha y Hora <b>MM/DD/AAAA H:M </b></i><br>
                  <i> - AC-No. Representa el ID Checador del Asesor en la plaza en cuestion</i><br>
                  <i> - No importa si el asesor tuvo 1, 2, 3, 4, 5, 6, 7 ... o "n" registros, se suben todos</i><br><br>
                  <span style="padding-left: 110px"><img src="vistas/img/plantilla/ejemploArchivo.png" alt=""></span>
                </div>
              </div>
              <br>
             <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon" style="font-size: 16px"><b>2 - El formato debe ser CSV(delimitado por comas) solamente</b></span>
                </div>
              </div>

            
              

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">
               
                  <div class="panel">SUBIR ARCHIVO</div>
                  <input type="file" class="nuevoArchivoChecador" name="nuevoArchivoChecador" required>
                  <p class="help-block">Peso maximo de la foto 2 MB</p>
                  <img src="" class="img-thumbnail previsualizar" width="100px" id="imgNuevaFoto">
                
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-primary" onclick="mostrarPreloaderChecador()">Subir archivo</button>
          </div>
           <?php

            $subirBase = new ControladorHorarios();
            $subirBase->ctrSubirBase();

          ?>
      </form>

  </div>
</div>
</div>

 <!--============================================
=             MODAL ANULAR BASE CHECADOR     =
=============================================-->
<div id="modalAnularBaseChecador" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:red; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Anular Base&nbsp;&nbsp;<i class="fa fa-upload" ></i></h4>
        </div>
         <div class="modal-body">
            <div class="box-body">
          
              <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon" style="font-size: 16px"><b>1 - Seleccione la fecha que desea borrar la base </b></span>
                </div>
              </div>
            
          
              <!-- ENTRADA PARA FECHA DE ANULACION -->
              <div class="form-group">
              
                  <input type="date" id="dtAnularBaseChecador" name="dtAnularBaseChecador" required>
  
                
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-danger" onclick="mostrarPreloaderChecador()">Borrar base</button>
          </div>
           <?php

            $borrarBaseChecador = new ControladorHorarios();
            $borrarBaseChecador->ctrBorrarBaseChecador();

          ?>
      </form>

  </div>
</div>
</div>

<!--============================================
=             MODAL SUBIR BASE ASISTENCIAS        =
=============================================-->
<div id="modalSubirBaseAsistencias" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Subir Base&nbsp;&nbsp;<i class="fa fa-upload" ></i></h4>
        </div>
         <div class="modal-body">
            <div class="box-body">
          
              <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon" style="font-size: 16px"><b>1 - El archivo debe tener la siguiente estructura</b></span>
                </div>
              </div>

            
              <div class="form-group">
                <div class="input-group">
                  <i> - Fijarse en el formato de la Fecha y Hora <b>MM/DD/AAAA</b></i><br>
                  <i> - NumEmp Representa el No. Socio del Asesor en la plaza en cuestion</i><br>
                  <i> - El comentario es opcional (no debe llevar comas el comentario)</i><br>
                   <i> - Existe 1 sola calificacion por dia por asesor</i><br>
                  <i> - Calificaciones disponibles son:</i><br>
                  <ul>
                    <li><b>DD</b> (Dia sin goce, permuta libre)</li>
                    <li><b>PE</b> (Permuta dia por dia)</li>
                    <li><b>V</b> (Vacaciones)</li>
                    <li><b>D</b> (Descanso)</li>
                    <li><b>R</b> (Retardo)</li>
                    <li><b>AA</b> (Doble asistencia por permuta libre)</li>
                    <li><b>A</b> (Asistencia)</li>
                    <li><b>FI</b> (Falta injustificada)</li>
                    <li><b>FJ</b> (Falta justificada)</li>
                    <li><b>I</b> (Incapacidad)</li>
                    <li><b>P</b> (Permiso)</li>
                    <li><b>RA</b> (Retardo en permuta)</li>
                  </ul>
                 <br>
                  <span><img src="vistas/img/plantilla/ejemploArchivoAsistencia.png" alt="" height="134px"></span>
                </div>
              </div>
              <br>
             <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon" style="font-size: 16px"><b>2 - El formato debe ser CSV(delimitado por comas) solamente</b></span>
                </div>
              </div>

            
              

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">
               
                  <div class="panel">SUBIR ARCHIVO</div>
                  <input type="file" class="nuevoArchivoChecador" name="nuevoArchivoAsistencias" required>
                  <p class="help-block">Peso maximo de la foto 2 MB</p>
                  <img src="" class="img-thumbnail previsualizar" width="100px" id="imgNuevaFoto">
                
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-primary" onclick="mostrarPreloaderChecador()">Subir archivo</button>
          </div>
           <?php

            $subirBaseAsistencias = new ControladorHorarios();
            $subirBaseAsistencias->ctrSubirBaseAsistencias();

          ?>
      </form>

  </div>
</div>
</div>

<div id="modalAnularBaseAsistencias" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:red; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Anular Base&nbsp;&nbsp;<i class="fa fa-upload" ></i></h4>
        </div>
         <div class="modal-body">
            <div class="box-body">
          
              <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon" style="font-size: 16px"><b>1 - Seleccione la fecha que desea borrar la base </b></span>
                </div>
              </div>
            
          
              <!-- ENTRADA PARA FECHA DE ANULACION -->
              <div class="form-group">
              
                  <input type="date" id="dtAnularBaseAsistencias" name="dtAnularBaseAsistencias" required>
  
                
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-danger" onclick="mostrarPreloaderChecador()">Borrar base</button>
          </div>
           <?php

            $borrarBaseAsistencias = new ControladorHorarios();
            $borrarBaseAsistencias->ctrBorrarBaseAsistencias();

          ?>
      </form>

  </div>
</div>
</div>
