<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar plazas
      </h1>
      <ol class="breadcrumb">
        <li><a href="usuariosSistemas"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar turnos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPlaza"> 
            Agregar plaza
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>ID</th>
                        <th>Plaza</th>                    
                        <th>Estado</th> 
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                  <?php
                  
                    
                    
                    $plazas = ControladorPlazas::mostrarPlazas();

                    foreach($plazas as $key => $value){

                      
                      echo '<tr> 
                                <td>'.$value["id"].'</td>
                                <td>'.utf8_decode($value["nombre"]).'</td>';
                          
                               
                                
                                
                                if($value["estado"] != 0){
                                  echo '<td><button class="btn btn-primary btn-xs btnActivarPlaza" idPlaza="'.$value["id"].'" statusPlaza="0">Activo</button></td>';
                                }else{
                                  echo ' <td><button class="btn btn-danger btn-xs btnActivarPlaza" idPlaza="'.$value["id"].'" statusPlaza="1">inactivo</button></td>';
                                } 
                               
                                 echo'
                                    <td> <button class="btn btn-warning btnEditarPlaza" data-toggle="modal" data-target="#modalEditarPlaza" idPlaza="'.$value["id"].'" ><i class="fa fa-pencil-alt"></i></button></td>
                                
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
=             MODAL AGREGAR TURNO      =
=============================================-->
<div id="modalAgregarPlaza" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar plaza</h4>
        </div>
         <div class="modal-body">
            <div class="box-body"> 

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="text" class="form-control input-lg" name="nuevaPlaza" placeholder="nombre plaza" required>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Guardar plaza</button>
          </div>
           <?php

            $crearPlaza = new ControladorPlazas();
            $crearPlaza->ctrAgregarPlaza();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR CAPACITADOR  ====-->


<!--============================================
=             MODAL AGREGAR TURNO      =
=============================================-->
<div id="modalEditarPlaza" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#FBB000; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar plaza</h4>
        </div>
         <div class="modal-body">
            <div class="box-body"> 

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>N</b></span>
                  <input type="hidden" name="idPlazaActual" id="idPlazaActual">
                  <input type="text" class="form-control input-lg" name="editarPlaza" id="editarPlaza" placeholder="nombre plaza" required>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-warning">Guardar cambios</button>
          </div>
           <?php

            $editarPlaza = new ControladorPlazas();
            $editarPlaza->ctrEditarPlaza();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR CAPACITADOR  ====-->

