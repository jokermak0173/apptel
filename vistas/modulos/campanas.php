<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar campañas
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar campañas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario" id="btnAgregarUsuario"> 
            Agregar campañas
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr> 
                        <th>Id Campaña</th> 
                        <th>Campaña</th>
                        <th>Estado</th>                    
                        
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item = "plaza";
                    $valor = $_SESSION["idPlaza"];
                    $item2 = null;
                    $valor2 = null;
                    $campañas = ControladorCampañas::ctrMostrarCampañasPlaza($item, $valor, $item2, $valor2);
                    
                    foreach($campañas as $key => $value){

                     
                      echo '<tr> 
                                <td>'.utf8_decode($value["id"]).'</td>
                                <td>'.utf8_decode($value["campana"]).'</td>';
                                
                                
                                if($value["activo"] != 0){
                                  echo '<td><button class="btn btn-primary btn-xs btnActivarCampaña" idCampaña="'.$value["id"].'" statusCampaña="0">Activa</button></td>';
                                }else{
                                  echo ' <td><button class="btn btn-danger btn-xs btnActivarCampaña" idCampaña="'.$value["id"].'" statusCampaña="1">Inactiva';
                               
                                 echo'
                                
                            </tr>';
                            
                                  }   
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
=             MODAL CAMPAÑA ASESOR          =
=============================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar campaña</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NOMBRE DE LA CAMPAÑA -->

               <div class="row">
                 <div class="col-md-12">
                   <div class="form-group">
                     <div class="input-group">
                      <span class="input-group-addon" ><i class="fa fa-campground"></i></span>
                      <input type="text" class="form-control input-lg" name="nuevaCampañaAgregar" placeholder="Nombre Campaña" required>

                    </div>
                   </div>
                 </div>
                 
               </div>
              

              
          
              
             

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Guardar campaña</button>
          </div>
           <?php

            $crearCampaña = new ControladorCampañas();
            $crearCampaña->ctrAgregarCampaña();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR ASESOR  ====-->

