<script>
var idPlaza = '<?php echo $_SESSION["idPlaza"];?>';

$(document).ready(function(){
  function mostrarTablaAsesores(idPlaza){
    var status = "alta";
  $('.tablaAsesores').DataTable( {
        "ajax": "ajax/datatable-asesores.ajax.php?idPlaza="+idPlaza+"&status="+status
 } );
}


  mostrarTablaAsesores(idPlaza);

});
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar asesores
      </h1>
      <ol class="breadcrumb">
        <li><a href="asesores"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar asesores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarAsesor" id="btnAgregarAsesor"> 
            Agregar asesor
           </button>
           <button class="btn btn-primary" data-toggle="modal" data-target="#modalSubirBaseAsesores"> 
            Alta por base <i class="fa fa-upload" ></i>
           </button>
           <button class="btn btn-danger" data-toggle="modal" data-target="#modalSubirBaseBajaAsesores"> 
            Baja por base <i class="fa fa-upload" ></i>
           </button>
            <form role="form" method="post" enctype="multipart/form-data">
              <input type="hidden" name="descargar" value="true">
              <button type="submit" class="btn btn-info" style="float:right"> 
                Descargar activos <i class="fa fa-download" ></i>
              </button> 
              <?php

              $descargarArchivo = new ControladorUsuarios();
              $descargarArchivo->ctrDescargarActivos();

              ?>
          </form> 
        </div>
      
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaAsesores" width="100%">  
                <thead> 
                 
                    <tr>  
                        <th>Num. Emp.</th>                   
                        <th>Nombre Completo</th>
                        <th>ID Checador</th>
                        <th>Plaza</th>
                        <th>Campaña</th>
                        <th>Turno</th>
                        <th>Foto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                  
                   
                   
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
<div id="modalAgregarAsesor" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar asesor</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>#</b></span>
                      <input type="text" class="form-control input-lg nuevoNumEmpleado" name="nuevoNumeroEmpleado" placeholder="Num. Empleado" id="nuevoNumEmpleado" required>

                    </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" ><i class="fas fa-fingerprint"></i></span>
                      <?php
                        echo ' <input type="text" class="form-control input-lg" name="nuevoIdChecador" id="nuevoIdChecador" plaza="'.$_SESSION["idPlaza"].'" placeholder="ID. Checador" required>';
                      ?>
                     
                    </div>
                   </div>
                 </div>
               </div>
              

              
          
             

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre" required>
                </div>
              </div>

             <div class="row">
               <div class="col-md-6">
                 <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-campground"></i></span>
                    <?php
                      echo' <select name="nuevaCampana" class="form-control input-lg" id="nuevaCampaña" plaza="'.$_SESSION["idPlaza"].'">';
                    ?>
                   
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
               <div class="col-md-6">
                 <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                    <select name="nuevoTurno" class="form-control input-lg" >
                      <option value="">Seleccionar Turno</option>
                      <?php
                        $item1 = "plaza";
                        $valor1 = $_SESSION["idPlaza"];
                        $item2 = "estado";
                        $valor2 = "1";
                        $turnos = ControladorTurnos::ctrMostrarTurnos();
                        foreach($turnos as $key => $value)
                            {
                             
                              echo '<option value="'.$value["id"].'">'.$value["horario_entrada"].' - '.$value["horario_salida"].'</option>';
                            }
                      ?>
                    </select>
                  </div>
                </div>
               </div>
             </div>
  
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>SP</b></span>
                  <select class="form-control input-lg" name="nuevoSupervisor" id="nuevoSupervisor" placeholder="Supervisor">
                     
                  </select>
                </div>
              </div>

        
             

              <!-- ENTRADA PARA SUBIR FOTO -->
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

            <button type="submit" class="btn btn-success">Guardar asesor</button>
          </div>
           <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario->ctrRegistrarAsesor();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR ASESOR  ====-->

<!--============================================
=             MODAL EDITAR ASESOR          =
=============================================-->
<div id="modalEditarAsesor" class="modal fade" role="dialog">
  <div class="modal-dialog">
   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#FBB000; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar asesor</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>#</b></span>
                      <input type="text" class="form-control input-lg" id="editarNumeroEmpleado" name="editarNumeroEmpleado" placeholder="Num. Empleado" readonly>

                    </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" ><i class="fas fa-fingerprint"></i></span>
                      <input type="text" class="form-control input-lg" id="editarIdChecador" name="editarIdChecador" placeholder="ID. Checador" readonly>
                    </div>
                   </div>
                 </div>
               </div>
              
                <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="editarPassword" placeholder="Reset Password" >
                  <input type="hidden" id="passwordActual" name="passwordActual" >
                </div>
              </div>
          
              

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" placeholder="Nombre" required>
                </div>
              </div>

             <div class="row">
               <div class="col-md-6">
                 <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-campground"></i></span>
                     <?php
                      echo' <select name="editarCampana" class="form-control input-lg" id="editarCampaña" plaza="'.$_SESSION["idPlaza"].'">';
                      ?>
                      <option value="" id="editarCampana"></option>
                         <?php

                            $campañasAsociadas = ControladorCampañas::ctrMostrarCampañasPlaza("plaza", $_SESSION["idPlaza"], "activo", 1);

                            foreach($campañasAsociadas as $key => $value)
                            {
                              
                              echo '<option value="'.$value["id"].'">'.$value["campana"].'</option>';
                            }
                            
                         
                        ?>
                    </select>
                  </div>
                </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                    <select  name="editarTurno" id="editTurno" class="form-control input-lg">
                    
                      
                    </select>
                  </div>
                </div>
               </div>
             </div>
            
             <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>SP</b></span>
                  <select class="form-control input-lg" name="editarSupervisor" id="editarSupervisor" placeholder="Supervisor" required>
                      <option value="" id="editSupervisor"></option>
                  </select>
                </div>
              </div>

               
             

              <!-- ENTRADA PARA SUBIR FOTO -->
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

            <button type="submit" class="btn btn-warning">Editar asesor</button>
          </div>
          <?php

          $editarAsesor = new ControladorUsuarios();
          $editarAsesor->ctrEditarAsesor();

        ?>
      </form>
  </div>
</div>
</div>  
<!--====  End of  MODAL EDITAR ASESOR  ====-->

<div id="modalSubirBaseAsesores" class="modal fade" role="dialog">
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
                  <i> - Fijarse en el formato del archivo separado por '<b>,</b>' y no por ';'</i><br>
                  <i> - Si no carga algun registro seguramente el numero empleado esta duplicado </i><br>
                  <i> - Fijarse bien en los codigos de campaña, turno y supervisor que pertenezcan a cada asesor</i><br><br>
                  <span ><img src="vistas/img/plantilla/ejemploArchivoAltaAsesores.png" alt="" width="550px"></span>
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
                  <input type="file" class="nuevoArchivoChecador" name="nuevoArchivoAsesores" required>
                 
                  <img src="" class="img-thumbnail previsualizar" width="100px" id="imgNuevaFoto">
                
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-primary" onclick="mostrarPreloaderChecador()">Subir archivo</button>
          </div>
           <?php

            $subirBase = new ControladorUsuarios();
            $subirBase->ctrSubirBaseAsesores();

          ?>
      </form>

  </div>
</div>
</div>

<div id="modalSubirBaseBajaAsesores" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:red; color:white">
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
                  <i> - Fijarse en el formato del archivo separado por '<b>,</b>' y no por ';'</i><br>
                  
                  <span ><img src="vistas/img/plantilla/ejemploArchivoBajaAsesores.png" alt=""></span>
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
                  <input type="file" class="nuevoArchivoChecador" name="nuevoArchivoBajaAsesores" required>
                 
                  <img src="" class="img-thumbnail previsualizar" width="100px" id="imgNuevaFoto">
                
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-primary" onclick="mostrarPreloaderChecador()">Subir archivo</button>
          </div>
           <?php

            $subirBase = new ControladorUsuarios();
            $subirBase->ctrSubirBaseBajaAsesores();

          ?>
      </form>

  </div>
</div>
</div>


<div id="modalReporteActivos" class="modal fade" role="dialog">
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

            <button  class="btn btn-success">Descargar</button>
          </div>
        

  </div>
</div>
</div>