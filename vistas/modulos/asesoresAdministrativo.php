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

                <div class="form-group">
                <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-chalkboard-teacher"></i></span>
                  <input type="text" class="form-control input-lg" id="editarCapacitador"  placeholder="Capacitador" disabled>
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
