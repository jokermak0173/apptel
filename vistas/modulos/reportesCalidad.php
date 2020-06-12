   <script type="text/javascript">
      $( function() {
          $( "#fechaInicio" ).datepicker({
             dateFormat: "yy-mm-dd"
          });
          $( "#fechaFin" ).datepicker({
             dateFormat: "yy-mm-dd"
          });
        } );
    </script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reportes
      </h1>

      <ol class="breadcrumb">
        <li><a href="permutasAdministrativo"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          
            <form role="form" method="post" enctype="multipart/form-data">
              <input type="hidden" name="descargar" value="true">
              <button type="submit" class="btn btn-info" style="float:left"> 
                Descargar activos <i class="fa fa-download" ></i>
              </button> 
              <?php

              $descargarArchivo = new ControladorUsuarios();
              $descargarArchivo->ctrDescargarActivos();

              ?>
          </form> 
          

         
        </div>
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          
          <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Descargar reporte de permutas</h4></center>
        </div>
         <div class="modal-body">
            <div class="box-body">



              <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>Inicio</b></span>
                     <input type="text" class="form-control input-lg" name="fechaInicio" id="fechaInicio" required>
                  
                    </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" style="font-size: 16px"><b>Fin</b></span>
                      <input type="text" class="form-control input-lg " name="fechaFin" id="fechaFin" required>

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
    </section>
  </div>



