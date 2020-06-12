<header class="main-header">
	<!--==============================
	=            LOGOTIPO            =
	===============================-->

	<a href="" class="logo" style="background:white">
		<!-- logo mini -->
		<span class="logo-mini">
			<img src="vistas/img/plantilla/atel.png" class="img-responsive" style="padding-top: 6px">
		</span>

		<!-- logo normal -->
	<!--  -->

	</a>

	<!--=========================================
	=            BARRA DE NAVEGACION            =
	==========================================-->
	<nav class="navbar navbar-static-top" role="navigation" style="background:#DF7401" >

		<!-- Boton de navegacion -->


		<!-- perfil de usuario -->
		<div class="navbar-custom-menu"  >
			<ul class="nav navbar-nav" >
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php

							if($_SESSION["foto"] == ""){
								echo '<img src="vistas/img/asesores/anonymous.png" class="user-image">';
							}
							else{
								echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
							}

						?>
						<span class="hidden-xs"><?php echo $_SESSION["nombreCompleto"];?></span>
					</a>
					<!-- Dropdown-toggle -->
					<ul class="dropdown-menu">
						<li class="user-header">
			               <?php

								if($_SESSION["foto"] == ""){
									echo '<img src="vistas/img/asesores/anonymous.png" class="img-circle">';
								}
								else{
									echo '<img src="'.$_SESSION["foto"].'" class="img-circle">';
								}

							?>

			                <p>
			                 <?php echo $_SESSION["nombreCompleto"];?>
			                  <small>Miembro desde <?php echo $_SESSION["mes_desde"];?>. <?php echo $_SESSION["anio_desde"];?></small>
			                </p>
			            </li>
						<li class="user-body">

							 <div class="row">
				                  <div class="col-xs-12 pull-left">
				                    <p><p><b><span style="color:#F18231">Plaza:&nbsp;&nbsp;&nbsp;</span><?php echo $_SESSION["nombrePlaza"];?></b></p>
				                  </div>
				                  <div class="col-xs-12 pull-left">
				                    <p><b><span style="color:#3A8A44">Campaña:&nbsp;&nbsp;&nbsp;</span><?php echo $_SESSION["campaniaNombre"];?></b></p>
				                  </div>
				                  <div class="col-xs-12 pull-left">
				                    <p><b><span style="color:#2445CD">Turno:&nbsp;&nbsp;&nbsp;</span> <?php echo $_SESSION["turno"];?></b> </p>
				                  </div>
				                    <div class="col-xs-12 pull-left">
				                    <p><b><span style="color:brown">Supervisor:&nbsp;&nbsp;&nbsp;</span>
				                   <?php


				                     echo $_SESSION["nombreSupervisor"];

				                     ?>
				                 	</b> </p>
				                  </div>

				              </div>
				           <div class="pull-left">
								<a href="#" data-toggle="modal" data-target="#modalCambioPasswordSesion"><i><span style="color: blue; text-decoration: underline;">Cambio password</span></i></a>
						  </div>
		                  <div class="pull-right">
								<a href="salir" class="btn btn-default btn-flat">Salir</a>
						  </div>
						</li>
					</ul>
				</li>
			</ul>
		</div>


	</nav>

</header>

<div class="modal fade" id="modalCambioPasswordSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" >
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Cambio de Password</b></h4>


      </div>
      <div class="modal-body">



        <div class="form-row">
          <div class="form-group col-md-12">
            <input type="password" class="form-control" name="passwordActual" style="border-radius: 4px"  placeholder="Password Actual" required>

          </div>
        </div>
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
          $cambiarPassAsesor->ctrCambiarPassAsesorSesion();

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
