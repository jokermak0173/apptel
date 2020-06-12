<?php
  
  $plazas = new ControladorPlazas();
  $plazasDisponibles = $plazas -> mostrarPlazas();
  //var_dump($plazasDisponibles);
?>



<div class="login-box">
  <div class="login-logo">
   <img src="vistas/img/plantilla/miAtel.png" class="img-responsive" ></img>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar al sistema</p>

    <form  method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Num. Empleado" name="numemp" id="txtNumEmpLogin" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingresoPassword" id="txtPassLogin" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

     <!--  <div class="form-group has-feedback">

        <select name="plaza" class="form-control" required>
          <option value="">Plaza</option> -->
          <?php
            // for ($i = 0; $i < count($plazasDisponibles); $i++){
            //   echo '<option value="'.$plazasDisponibles[$i]["id"].'">'.$plazasDisponibles[$i]["nombre"].'</option>';
            // }
          ?>
        <!-- </select>
       

      </div> -->


      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="btnLogin" type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>


      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();

      ?>
    </form>

    
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- <div class="spinnerLogin"></div> -->

<!-- Modal -->
<div class="modal fade" id="modalCambioPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" >
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Cambio de Password</b></h4>
        
        
      </div>
      <div class="modal-body">
        <p>
          Tu password es el de por defecto, CAMBIALO!
        </p>


        
        <div class="form-row">
          <div class="form-group col-md-12">
            <input type="password" class="form-control check-seguridad" name="nuevoCambioPassword" style="border-radius: 4px"  placeholder="Nuevo Password" required>
            <input type="hidden" id="numempCambioPassword" name="numempCambioPassword">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <input type="password" class="form-control check-seguridad" name="confirmaCambioPassword"  style="border-radius: 4px"  placeholder="Confirma Password" required>
          </div>
        </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Cambiar Password</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>     
      </div>

      <?php

          $cambiarPassAsesor = new ControladorUsuarios();
          $cambiarPassAsesor->ctrCambiarPassAsesor();

        ?>
    </form>
    </div>
  </div>
</div>
<script>
  $('.check-seguridad').strength({
    templates: {
                toggle: '<span class="input-group-addon"><span class="glyphicon glyphicon-eye-open {toggleClass}"></span></span>'
                 
                },
    scoreLables: {
                        empty: 'Vacío',
                        invalid: 'Invalido',
                        weak: 'Débil',
                        good: 'Bueno',
                        strong: 'Fuerte'
                    }, 
  });
</script>
