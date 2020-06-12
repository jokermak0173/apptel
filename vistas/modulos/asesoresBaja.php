<script>
var idPlaza = '<?php echo $_SESSION["idPlaza"];?>';

$(document).ready(function(){

  function mostrarTablaAsesoresBaja(idPlaza){
  var status = "baja";
  $('.tablaAsesoresBaja').DataTable( {
    
        "ajax": "ajax/datatable-asesores.ajax.php?idPlaza="+idPlaza+"&status="+status
 } );
}
  mostrarTablaAsesoresBaja(idPlaza);

});
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asesores baja
      </h1>
      <ol class="breadcrumb">
        <li><a href="asesores"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Asesores baja</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
         
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaAsesoresBaja" width="100%">  
                <thead> 
                    <tr>  
                        <th>Num. Emp.</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Nombre</th>
                        <th>ID Checador</th>
                        <th>Plaza</th>
                        <th>Campaña</th>
                        <th>Turno</th>
                        <th>Foto</th>
                        <th>Estado</th>       
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

