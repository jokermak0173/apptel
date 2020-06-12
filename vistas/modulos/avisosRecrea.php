<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar publicaciones
      </h1>
      <ol class="breadcrumb">
        <li><a href="asesores"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar publicaciones</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarAviso" > 
            Agregar publicacion
           </button>
        </div>
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">  
                <thead> 
                    <tr>  
                        <th>Fecha Publicacion.</th>
                        <th>Imagen</th>
                        <th>Plaza</th>
                        <th>Fecha Exp.</th>
                        <th>Acciones</th>
                        
                    </tr>
                </thead>
                <tbody> 
                  <?php
                    $item = "numemp";
                    $valor = $_SESSION["numemp"];
                    
                    $avisos = ControladorAvisos::ctrMostrarAvisos($item, $valor);
                    
                    foreach($avisos as $key => $value){

                      $plazaAviso = ControladorPlazas::ctrMostrarPlaza("id", $value["plaza"]);
                     
                      echo '<tr> 
                                <td>'.$value["fecha_publicacion"].'</td>';
                               
                                if($value["imagen"] != "")
                                {
                                    echo '<td><img src="'.$value["imagen"].'" class="  img-thumnail" width="40px"></td>';
                                }else{
                                  echo '<td><img src="vistas/img/avisos/sin_imagen.png" class="  img-thumnail" width="40px"></td>';
                                }
                                
                              echo '<td>'.$plazaAviso["nombre"].'</td>';
                              echo '<td>'.$value["fecha_expiracion"].'</td>';     

                              echo'
                                <td>  
                                  <div class="btn-group"> 
                                    <button class="btn btn-warning btnEditarAviso" data-toggle="modal" data-target="#modalEditarAviso" idAviso="'.$value["id"].'" ><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btnBorrarAviso" idAviso="'.$value["id"].'" ><i class="fa fa-times"></i></button>
                                    
                                  </div>
                                </td>';         
                               
                                echo'
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
=             MODAL PUBLICAR AVISO       =
=============================================-->
<div id="modalAgregarAviso" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#28A42A; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar publicacion</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

              

              
          
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>TXT</b></span>
                  <textarea name="textoAviso" id="textoAviso" cols="68" rows="5" class="form-control"></textarea>
                </div>
              </div>

              

            

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">
               
                  <div class="panel">SUBIR IMAGEN</div>
                  <input type="file" class="nuevaFoto" name="nuevaImagenAviso">
                  <p class="help-block">Peso maximo de la foto 200 MB</p>
                  <img src="" class="img-thumbnail previsualizar" width="400px" >
                
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>EXP</b></span>
                  <input type="date" class="form-control input-lg" name="fechaExpiracionAviso" required>
                </div>
              </div>

                <div class="form-group">
                <div class="input-group">
                 
                  
                  <input type="checkbox" name="importante" value="1"> Importante<br>
                </div>
              </div>


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-success">Publicar</button>
          </div>
           <?php

            $agregarAviso = new ControladorAvisos();
            $agregarAviso->ctrAgregarAviso();

          ?>
      </form>

  </div>
</div>
</div>
<!--====  End of  MODAL AGREGAR ASESOR  ====-->

<!--============================================
=             MODAL EDITAR AVISO       =
=============================================-->
<div id="modalEditarAviso" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#FBB000; color:white" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar publicacion</h4>
        </div>
         <div class="modal-body">
            <div class="box-body">

               <!-- ENTRADA PARA EL NUM EMP -->

              

              
          
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>TXT</b></span>
                  <textarea name="editarTextoAviso" id="editarTextoAviso" cols="68" rows="5" class="form-control" readonly></textarea>
                </div>
              </div>

              

            

              <!-- ENTRADA PARA SUBIR FOTO -->
              <div class="form-group">
               
                  <div class="panel">IMAGEN</div>
                  
                  
                  <img src="" class="img-thumbnail previsualizar" width="400px" >
                
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style="font-size: 16px"><b>EXP</b></span>
                  <input type="hidden" id="idAviso" name="idEditarAviso">
                  <input type="date" class="form-control input-lg" name="editarFechaExpiracionAviso" required>
                </div>
              </div>

  


            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-warning">Editar publicacion</button>
          </div>
           <?php

            $editarAviso = new ControladorAvisos();
            $editarAviso->ctrEditarAviso();

          ?>
      </form>

  </div>
</div>
</div>