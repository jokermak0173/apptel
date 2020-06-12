<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario "> 
            Agregar usuario
           </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas">  
                <thead> 
                    <tr>  
                        <th style="width:10px">#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Foto</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Ultimo login</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr> 
                        <td>1</td>
                        <td>Usuario Administrador</td>
                        <td>admin</td>
                        <td><img src="  vistas/img/usuarios/default/anonymous.png" class="  img-thumnail" width="40px"></td>
                         <td>Administrador</td>
                        <td><button class="btn btn-success btn-xs">Activado</button></td>
                        <td>2017-12-11 12:05:32</td>
                        <td>  
                          <div class="btn-group"> 
                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                    </tr>
                </tbody>
          </table>
        </div>
        <!-- /.box-body -->
       
      </div>


    </section>
   
  </div>

<!--============================================
=             MODAL AGREGAR USUARIO            =
=============================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <div class="modal-header" style="background:#3c8dbc; color:white" >
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar usuario</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!--====  End of  MODAL AGREGAR USUARIO  ====-->
