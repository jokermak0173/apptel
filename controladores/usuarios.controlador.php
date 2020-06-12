<?php

	class ControladorUsuarios{

		/*==========================================
		=            INGRESO DE USUARIO            =
		==========================================*/

		public function ctrIngresoUsuario(){
			if(isset($_POST["numemp"]) && isset($_POST["ingresoPassword"])){

				if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["numemp"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

					$tabla = "usuario";
					$item = "numemp";
					$valor = $_POST["numemp"];

					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

					$tabla = "plaza";
					$item = "id";
					$valor = $respuesta["plaza"];
					$plaza = ModeloPlazas::mdlMostrarPlaza($tabla, $item, $valor);

					$tabla = "campana_plaza";
					$item = "id";
					$valor = $respuesta["campana"];
					$campaña = ModeloCampañas::mdlMostrarCampaña($tabla, $item, $valor);

					$tabla = "turno";
					$item = "id";
					$valor = $respuesta["turno"];
					$turno = ModeloTurno::mdlMostrarTurno($tabla, $item, $valor);

					$tabla = "supervisor";
					$item = "id";
					$valor = $respuesta["supervisor"];
					$supervisor = ModeloSupervisores::mdlMostrarSupervisor($tabla, $item, $valor);

					$passwordEncriptado = md5($_POST["ingresoPassword"]);

					if($respuesta["numemp"] == $_POST["numemp"] && $respuesta["password"] == $passwordEncriptado){

						if($respuesta["status_usuario"] == 1)
						{

								if($passwordEncriptado !== "29bd4d530872f027116f839de971b1ab")
								{

									$_SESSION["iniciarSesion"] = "ok";
								$_SESSION["nombreCompleto"] = utf8_decode($respuesta["nombre_completo"]);
								$_SESSION["nombreCompleto2"] = utf8_decode($respuesta["nombre_completo"]);
								$_SESSION["nombrePlaza"] = utf8_decode($plaza["nombre"]);
								$_SESSION["idPlaza"] = $plaza["id"];
								$_SESSION["idTurno"] = $respuesta["turno"];
								$mes_desde = date("m", strtotime($respuesta["usuario_desde"]));
								$anio_desde = date("Y", strtotime($respuesta["usuario_desde"]));
								$_SESSION["anio_desde"] = $anio_desde;
								$_SESSION["campaniaNombre"] = utf8_decode($campaña["campana"]);
								$_SESSION["campania"] = $respuesta["campana"];
								$_SESSION["turno"] = $turno["horario_entrada"]." - ".$turno["horario_salida"];
								$_SESSION["horario_entrada"] = $turno["horario_entrada"];
								$_SESSION["foto"] = $respuesta["foto"];
								$_SESSION["nivelAcceso"] = $respuesta["nivel_acceso"];
								$_SESSION["numemp"] = $respuesta["numemp"];
								$_SESSION["idChecador"] = $respuesta["id_checador"];
								$_SESSION["nombreSupervisor"] = utf8_decode($supervisor["nombre"])." ".utf8_decode($supervisor["apellido_paterno"])." ".utf8_decode($supervisor["apellido_materno"]);


								switch($mes_desde){
									case 1: $_SESSION["mes_desde"] = "Ene"; break;
									case 2: $_SESSION["mes_desde"] = "Feb"; break;
									case 3: $_SESSION["mes_desde"] = "Mar"; break;
									case 4: $_SESSION["mes_desde"] = "Abr"; break;
									case 5: $_SESSION["mes_desde"] = "May"; break;
									case 6: $_SESSION["mes_desde"] = "Jun"; break;
									case 7: $_SESSION["mes_desde"] = "Jul"; break;
									case 8: $_SESSION["mes_desde"] = "Ago"; break;
									case 9: $_SESSION["mes_desde"] = "Sep"; break;
									case 10: $_SESSION["mes_desde"] = "Oct"; break;
									case 11: $_SESSION["mes_desde"] = "Nov"; break;
									case 12: $_SESSION["mes_desde"] = "Dic"; break;
								}
								/*===============================================================
								=          REGISTRAR FECHA PARA SABER ULTIMO LOGIN            =
								===============================================================*/
								date_default_timezone_set('America/Mexico_City');
								$fecha = date('Y-m-d');
								$hora = date('H:i:s');
								$fechaActual = $fecha.' '.$hora;

								$item1 = "ultimo_login";
								$valor1 = $fechaActual;

								$item2 = "numemp";
								$valor2 = $respuesta["numemp"];

								$item3 = "status_sesion";
								$valor3 = "1";

								$item4 = "ip_pc";
								$valor4 = $_SERVER["REMOTE_ADDR"];

								$item5 = "nombre_pc";
								$valor5 = gethostname();

								$tabla = "usuario";
								$ultimoLogin = ModeloUsuarios::mdlActualizarLoginUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5);

								if($ultimoLogin == "ok"){
									switch($_SESSION["nivelAcceso"])
									{

										case 1: echo '<script>window.location = "usuariosSistemas";</script>';break;
										case 2: echo '<script>window.location = "avisos";</script>';break;
										case 3: echo '<script>window.location = "avisos";</script>';break;
										case 4: echo '<script>window.location = "avisos";</script>';break;
										case 5: echo '<script>window.location = "avisos";</script>'; break;
										case 6: echo '<script>window.location = "avisos";</script>'; break;
										case 7: echo '<script>window.location = "avisosVallarta";</script>'; break;
										case 999: echo '<script>window.location = "plazasRoot";</script>'; break;
									}
								}

								}else{

										echo '<script>
												$(document).ready(function(){
												$("#modalCambioPassword").modal("show");
												$("#numempCambioPassword").val('.$_POST["numemp"].');
											})
										 </script>';
								}





						}else{
							echo '<br><div class="alert alert-warning">Cuenta deshabilitada</div>';
						}

					}else{
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
					}
				}
			}
		}

		/*========================================
		=            MOSTRAR ASESORES            =
		========================================*/
		static public function ctrMostrarAsesores($valores){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarAsesores($tabla, $valores);
			return $respuesta;

		}

		static public function ctrMostrarUsuario($item, $valor){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
			return $respuesta;

		}

		/*========================================
		=            MOSTRAR USUARIOS SISTEMAS            =
		========================================*/
		static public function ctrMostrarUsuariosSistemas($item1, $valor1, $item2, $valor2, $item3, $valor3, $valor4, $valor5, $valor6){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarUsuariosSistemas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $valor4, $valor5, $valor6);
			return $respuesta;

		}

		static public function ctrMostrarUsuariosRoot($item1, $valor1){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarUsuariosRoot($tabla, $item1, $valor1);
			return $respuesta;

		}


		/*========================================
		=            MOSTRAR ASESOR POR ID TABLA            =
		========================================*/
		static public function ctrMostrarAsesorPorId($item, $valor){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarAsesorPorId($tabla, $item, $valor);
			return $respuesta;

		}

		/*========================================
		=            MOSTRAR ASESOR POR ID TABLA            =
		========================================*/
		static public function ctrMostrarAsesorChecador($item1, $valor1, $item2, $valor2){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarAsesorChecador($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;

		}

		/*========================================
		=            REGISTRAR ASESOR            =
		========================================*/

		static public function ctrRegistrarAsesor(){
			$datosSonCorrectos = true;
			if (isset($_POST["nuevoNumeroEmpleado"])){

				if(!preg_match('/^[0-9]+$/',  $_POST["nuevoNumeroEmpleado"])){
					$datosSonCorrectos = false;
					echo '<script>
							swal({
								type: "error",
								title: "¡El NUM. EMP. debe contener solo numeros!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});

						 </script>';
				}

				if(!preg_match('/^[0-9]+$/',  $_POST["nuevoIdChecador"])){
					$datosSonCorrectos = false;
					echo '<script>
							swal({
								type: "error",
								title: "¡El ID CHECADOR debe contener solo numeros!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});

						 </script>';

				}
				if(!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){
					$datosSonCorrectos = false;
					echo '<script>
							swal({
								type: "error",
								title: "¡El NOMBRE no puede ir vacio o llevar caracteres especiales!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});

						 </script>';
				}


				if(!isset($_POST["nuevoSupervisor"])){
					$datosSonCorrectos = false;
					echo '<script>
							swal({
								type: "error",
								title: "¡No seleccionaste un supervisor!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});

						 </script>';
				}


				if($datosSonCorrectos){

					$ruta = "vistas/img/asesores/anonymous.png";
					/* VALIDAR IMAGEN */
						if(isset($_FILES["nuevaFoto"]["tmp_name"])){


							if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){


								$ruta = "vistas/img/asesores/".$_POST["nuevoNumeroEmpleado"].".jpg";
								$tmp_archivo = $_FILES["nuevaFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);


							}

							if($_FILES["nuevaFoto"]["type"] == "image/png"){


								$ruta = "vistas/img/asesores/".$_POST["nuevoNumeroEmpleado"].".png";
								$tmp_archivo = $_FILES["nuevaFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);

							}


						}

						$tabla = "usuario";
						$passwordDefault = "atel";
						$passwordDefaultEncriptado = md5($passwordDefault);
						$datos = array( "numemp" => $_POST["nuevoNumeroEmpleado"],
										"idchecador" => $_POST["nuevoIdChecador"],

										"nombre" => utf8_encode(ucwords($_POST["nuevoNombre"])),
										"campana" => $_POST["nuevaCampana"],
										"turno" => $_POST["nuevoTurno"],

										"supervisor" => $_POST["nuevoSupervisor"],
										"nivel" => 5,
										"status" => "1",
										"plaza" => $_SESSION["idPlaza"],
										"password" => $passwordDefaultEncriptado,
										"foto" => $ruta);
						$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡El asesor	 se dio de alta correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});

						 </script>';

						}
				}else{
					echo '<script>
							swal({
								type: "error",
								title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "asesoresNominas";
								}
							});

						 </script>';

				}
			}
		}

		/*=====  End of REGISTRAR ASESOR  ======*/


		/*======================================
		=            EDITAR USUARIO            =
		======================================*/
		public function ctrEditarAsesor(){
			$location = "";
			switch($_SESSION["nivelAcceso"]){
				case 2: $location = "asesoresNominas"; break;
				case 4: $location = "asesoresAdministrativo"; break;

			}
			if(isset($_POST["editarNumeroEmpleado"])){


						/*======================================
						=            VALIDAR IMAGEN            =
						======================================*/
						$ruta = $_POST["fotoActual"];

						if($_FILES["editarFoto"]["type"] == "image/jpeg" || $_FILES["editarFoto"]["type"] == "image/png"){

							$fotoAntiguaJPG = "vistas/img/asesores/".$_POST["editarNumeroEmpleado"].".jpg";
							$fotoAntiguaPNG = "vistas/img/asesores/".$_POST["editarNumeroEmpleado"].".png";
							if(file_exists($fotoAntiguaJPG)){
								unlink($fotoAntiguaJPG);
							}
							if(file_exists($fotoAntiguaPNG)){
								unlink($fotoAntiguaPNG);
							}
							if($_FILES["editarFoto"]["type"] == "image/jpeg"){

								$ruta = "vistas/img/asesores/".$_POST["editarNumeroEmpleado"].".jpg";
								$tmp_archivo = $_FILES["editarFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);
							}//else if($_FILES["editarFoto"]["type"] == "image/png"){
								else{$ruta = "vistas/img/asesores/".$_POST["editarNumeroEmpleado"].".png";
								$tmp_archivo = $_FILES["editarFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);
							}

						}

						if($_POST["editarPassword"] != ""){
							if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
								$passwordEncriptado = md5($_POST["editarPassword"]);
							}else{

								echo '<script>
										swal({
											type: "error",
											title: "¡El password no puede ir vacio o llevar caracteres especiales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "'.$location.'";
											}
										});

									 </script>';
							}

						}else{
							$passwordEncriptado = $_POST["passwordActual"];
						}

						$datos = array("numemp" => $_POST["editarNumeroEmpleado"],
									   "idChecador" => $_POST["editarIdChecador"],
									   "password" => $passwordEncriptado,

									   "nombre" => utf8_encode(ucwords($_POST["editarNombre"])),
									   "campaña" => $_POST["editarCampana"],
									   "supervisor" => $_POST["editarSupervisor"],
									   "turno" => $_POST["editarTurno"],
									   "foto" => $ruta,
									   "nivel" => 5);
						$tabla = "usuario";
						$respuesta = ModeloUsuarios::mdlEditarAsesor($tabla, $datos);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡El asesor ha sido editado correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "'.$location.'";

								}
							});

						 </script>';

						}


			}
		}

		static public function ctrLiberarSesionUsuario($item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){
			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlLiberarSesionUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);


			return $respuesta;

		}

		static public function ctrRegistrarUsuarioSistemas(){
			if(isset($_POST["nuevoNumeroEmpleadoSistemas"])){

				if($_POST["nuevoNivelSistemas"] <= 1 || $_POST["nuevoNivelSistemas"] == 5 || $_POST["nuevoNivelSistemas"] > 7){
					echo '<script>
								swal({
									type: "error",
									title: "No tienes privilegios de crear usuarios de ese nivel de acceso",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "usuariosSistemas";
									}
								});

							 </script>';
				}else{
					if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreSistemas"]) ) {

						$ruta = "vistas/img/asesores/anonymous.png";
						/* VALIDAR IMAGEN */
						if(isset($_FILES["nuevaFoto"]["tmp_name"])){


							if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){


								$ruta = "vistas/img/asesores/".$_POST["nuevoNumeroEmpleadoSistemas"].".jpg";
								$tmp_archivo = $_FILES["nuevaFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);


							}

							if($_FILES["nuevaFoto"]["type"] == "image/png"){


								$ruta = "vistas/img/asesores/".$_POST["nuevoNumeroEmpleadoSistemas"].".png";
								$tmp_archivo = $_FILES["nuevaFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);

							}


						}

						$tabla = "usuario";
						$passwordDefault = "atel";
						$passwordDefaultEncriptado = md5($passwordDefault);
						$datos = array( "numemp" => $_POST["nuevoNumeroEmpleadoSistemas"],
											"idchecador" => $_POST["nuevoIdChecadorSistemas"],

											"nombre" => utf8_encode(ucwords($_POST["nuevoNombreSistemas"])),
											"campana" => null,
											"turno" => null,
											"supervisor" => null,

											"nivel" => $_POST["nuevoNivelSistemas"],
											"status" => 1,
											"plaza" => $_SESSION["idPlaza"],
											"password" => $passwordDefaultEncriptado,
											"foto" => $ruta);
							$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
							if($respuesta == "ok"){
								echo '<script>
								swal({
									type: "success",
									title: "¡El usuario se dio de alta correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "usuariosSistemas";
									}
								});

							 </script>';

							}else{
								echo '<script>
								swal({
									type: "error",

									title: "Algun error hubo al agregar al usuario'.$respuesta[2].'",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "usuariosSistemas";
									}
								});

							 </script>';
							}


				}else{

				echo '<script>
						swal({
							type: "error",
							title: "¡El NOMBRE Y APELLIDOS no pueden ir vacios o llevar caracteres especiales!",
							showConfirmbutton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){
							if(result.value){
								window.location = "usuariosSistemas";
							}
						});
					 </script>';
				}
				}



			}

		}

		static public function ctrRegistrarUsuarioRoot(){

			if(isset($_POST["nuevoNumeroEmpleadoRoot"])){

					if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreSistemas"])) {

						$ruta = "vistas/img/asesores/anonymous.png";
						/* VALIDAR IMAGEN */
						if(isset($_FILES["nuevaFoto"]["tmp_name"])){


							if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){


								$ruta = "vistas/img/asesores/".$_POST["nuevoNumeroEmpleadoRoot"].".jpg";
								$tmp_archivo = $_FILES["nuevaFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);


							}

							if($_FILES["nuevaFoto"]["type"] == "image/png"){


								$ruta = "vistas/img/asesores/".$_POST["nuevoNumeroEmpleadoRoot"].".png";
								$tmp_archivo = $_FILES["nuevaFoto"]["tmp_name"];
								move_uploaded_file($tmp_archivo, $ruta);

							}


						}

						$tabla = "usuario";
						$passwordDefault = "atel";
						$passwordDefaultEncriptado = md5($passwordDefault);

						$datos = array( "numemp" => $_POST["nuevoNumeroEmpleadoRoot"],
											"idchecador" => $_POST["nuevoIdChecadorRoot"],

											"nombre" => utf8_encode(ucwords($_POST["nuevoNombreSistemas"])),
											"campana" => 0,
											"turno" => 0,
											"supervisor" => 0,

											"nivel" => $_POST["nuevoNivelSistemas"],
											"status" => "1",
											"plaza" => $_POST["nuevaPlazaRoot"],
											"password" => $passwordDefaultEncriptado,
											"foto" => $ruta);
							$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
								$ar = fopen("archivoIngresoUsuario.txt", "w");
			fwrite($ar, $respuesta);
			fclose($ar);
							echo "<h2>".$_POST["nuevoApellidoPaternoSistemas"]."</h2>";
							if($respuesta == "ok"){
								echo '<script>
								swal({
									type: "success",
									title: "¡El usuario se dio de alta correctamente!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "usuariosRoot";
									}
								});

							 </script>';

							}else{
								echo '<script>
								swal({
									type: "error",
									title: "Algun error hubo al agregar al usuario'.$respuesta.'",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "usuariosRoot";
									}
								});

							 </script>';
							}


				}else{

				echo '<script>
						swal({
							type: "error",
							title: "¡El NOMBRE Y APELLIDOS no pueden ir vacios o llevar caracteres especiales!",
							showConfirmbutton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){
							if(result.value){
								window.location = "usuariosRoot";
							}
						});
					 </script>';
				}




			}

		}

		static public function ctrEditarUsuarioSistemas(){
			if(isset($_POST["editarNumeroEmpleadoSistemas"])){

				if($_POST["editarNivelSistemas"] <= 1 || $_POST["editarNivelSistemas"] > 4){
					echo '<script>
								swal({
									type: "error",
									title: "No tienes privilegios de crear usuarios de ese nivel de acceso",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "usuariosSistemas";
									}
								});

							 </script>';
				}else{
					if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreSistemas"])) {


						if($_POST["editarPasswordSistemas"] != ""){
							if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPasswordSistemas"])){
								$passwordEncriptado = md5($_POST["editarPasswordSistemas"]);
							}else{
								echo '<script>
										swal({
											type: "error",
											title: "¡El password no puede ir vacio o llevar caracteres especiales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "usuariosSistemas";
											}
										});

									 </script>';
							}

						}else{
							$passwordEncriptado = $_POST["passwordActualSistemas"];
						}
						$ruta = "vistas/img/asesores/anonymous.png";
						$datos = array("numemp" => $_POST["editarNumeroEmpleadoSistemas"],
									   "idChecador" => 0,
									   "password" => $passwordEncriptado,

									   "nombre" => utf8_encode(ucwords($_POST["editarNombreSistemas"])),
									   "campaña" => $_POST["editarCampanaSistemas"],
									   "turno" => 0,
									   "foto" => $ruta,
									   "nivel" => $_POST["editarNivelSistemas"]);
						$tabla = "usuario";
						$respuesta = ModeloUsuarios::mdlEditarAsesor($tabla, $datos);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡El usuario ha sido editado correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "usuariosSistemas";

								}
							});

						 </script>';

						}else{

							echo '<script>
							swal({
								type: "error",
								title: "¡Error en la edicion, Cod. Err: '.$respuesta[1].' !",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "usuariosSistemas";

								}
							});

						 </script>';
						}

				}else{
					echo '<script>
										swal({
											type: "error",
											title: "¡El NOMBRE  no puede ir vacio
											 o llevar caracteres especiales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "usuariosSistemas";
											}
										});

									 </script>';
				}
				}

			}

		}

		static public function ctrTraerTokens($plaza){
			$tabla = "usuario";
			$item1 = "status_usuario";
			$valor1 = "1";
			$item2 = "plaza";
			$valor2 = $plaza;
			$respuesta = ModeloUsuarios::mdlTraerTokens($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrTraerTokensCampana($campana){
			$tabla = "usuario";
			$item1 = "status_usuario";
			$valor1 = "1";
			$item2 = "campana";
			$valor2 = $campana;
			$respuesta = ModeloUsuarios::mdlTraerTokens($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}


		static public function ctrEditarUsuarioRoot(){
			if(isset($_POST["editarNumeroEmpleadoRoot"])){


					if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreRoot"])) {


						if($_POST["editarPasswordRoot"] != ""){
							if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPasswordRoot"])){
								$passwordEncriptado = md5($_POST["editarPasswordRoot"]);
							}else{
								echo '<script>
										swal({
											type: "error",
											title: "¡El password no puede ir vacio o llevar caracteres especiales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "usuariosSistemas";
											}
										});

									 </script>';
							}

						}else{
							$passwordEncriptado = $_POST["passwordActualRoot"];
						}
						$ruta = "vistas/img/asesores/anonymous.png";
						$datos = array("numemp" => $_POST["editarNumeroEmpleadoRoot"],
									   "idChecador" => "",
									   "password" => $passwordEncriptado,

									   "nombre" => utf8_encode(ucwords($_POST["editarNombreRoot"])),
									   "campaña" => 0,
									   "turno" => 0,
									   "foto" => $ruta,
									   "nivel" => $_POST["editarNivelRoot"]);
						$tabla = "usuario";
						$respuesta = ModeloUsuarios::mdlEditarAsesor($tabla, $datos);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡El usuario ha sido editado correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "usuariosRoot";

								}
							});

						 </script>';

						}else{

							echo '<script>

							swal({
								type: "error",
								title: "¡Error en la edicion, Cod. Err: '.$respuesta[2].' !",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "usuariosRoot";

								}
							});

						 </script>';
						}

				}else{
					echo '<script>
										swal({
											type: "error",
											title: "¡El NOMBRE Y APELLIDOS no pueden ir vacios o llevar caracteres especiales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "usuariosRoot";
											}
										});

									 </script>';
				}


			}

		}

		static public function ctrCambiarPassAsesor(){
			if(isset($_POST["nuevoCambioPassword"])){
				if(isset($_POST["nuevoCambioPassword"]) && isset($_POST["confirmaCambioPassword"]) && strlen($_POST["nuevoCambioPassword"]) > 0 && strlen($_POST["confirmaCambioPassword"]) > 0 ){

					if($_POST["nuevoCambioPassword"] == $_POST["confirmaCambioPassword"]){

						if($_POST["nuevoCambioPassword"] != "atel"){
							$tabla = "usuario";
							$tabla2 = "usuario_pruebas";
							$password = $_POST["nuevoCambioPassword"];

							$item1 = "password";
							$valor1 = md5($password);
							$item2 = "numemp";
							$valor2 =  $_POST["numempCambioPassword"];

							$respuesta2 = ModeloUsuarios::mdlCambio($tabla2, $item2, $valor2 , $item1, $password);
							$respuesta = ModeloUsuarios::mdlCambiarPassAsesor($tabla, $item1, $valor1, $item2, $valor2);

							if($respuesta == "ok" && $respuesta2 == "ok"){
								echo '<script>
									swal({
										type: "success",
										title: "¡Password cambiado correctamente!",
										showConfirmbutton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then(function(result){
										if(result.value){
											window.location = "login";
										}
									});

							 </script>';
							}else{
								echo '<script>
									swal({
										type: "error",
										title: "¡Error al cambiar password Err# '.$respuesta2[1].'",
										showConfirmbutton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then(function(result){
										if(result.value){
											window.location = "login";
										}
									});

							 </script>';
							}



						}else{
							echo '<script>
									swal({
										type: "error",
										title: "¡Pusiste el password por defecto!",
										showConfirmbutton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then(function(result){
										if(result.value){
											window.location = "login";
										}
									});

							 </script>';

						}

					}else{
						echo '<script>
								swal({
									type: "error",
									title: "¡Campos no coinciden!",
									showConfirmbutton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then(function(result){
									if(result.value){
										window.location = "login";
									}
								});

						 </script>';

					}


				}else{
				echo '<script>
										swal({
											type: "error",
											title: "¡Completa ambos campos!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "login";
											}
										});

									 </script>';

			}


			}
		}

		static public function ctrCambiarPassAsesorSesion(){
			if(isset($_POST["passwordActual"])){
				$passEncriptado = md5($_POST["passwordActual"]);
				$passAsesorActual = ModeloUsuarios::mdlMostrarUsuarios("usuario", "numemp", $_SESSION["numemp"]);
				if($passEncriptado == $passAsesorActual["password"]){
					if(isset($_POST["nuevoCambioPassword"]) && isset($_POST["confirmaCambioPassword"]) && strlen($_POST["nuevoCambioPassword"]) > 0 && strlen($_POST["confirmaCambioPassword"]) > 0 ){

						if($_POST["nuevoCambioPassword"] == $_POST["confirmaCambioPassword"]){

							if($_POST["nuevoCambioPassword"] != "atel"){
								$tabla = "usuario";
								$tabla2 = "usuario_pruebas";
								$password = $_POST["nuevoCambioPassword"];

								$item1 = "password";
								$valor1 = md5($password);
								$item2 = "numemp";
								$valor2 =  $_SESSION["numemp"];

								$respuesta2 = ModeloUsuarios::mdlCambio($tabla2, $item2, $valor2 , $item1, $password);
								$respuesta = ModeloUsuarios::mdlCambiarPassAsesor($tabla, $item1, $valor1, $item2, $valor2);

								if($respuesta == "ok" && $respuesta2 == "ok"){
									echo '<script>
										swal({
											type: "success",
											title: "¡Password cambiado correctamente!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){

										});

								 </script>';
								}else{
									echo '<script>
										swal({
											type: "error",
											title: "¡Error al cambiar password Err# '.$respuesta2[1].'",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){

										});

								 </script>';
								}



							}else{
								echo '<script>
										swal({
											type: "error",
											title: "¡Pusiste el password por defecto!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){

										});

								 </script>';

							}

						}else{
							echo '<script>
									swal({
										type: "error",
										title: "¡Campos no coinciden!",
										showConfirmbutton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false
									}).then(function(result){

									});

							 </script>';

						}


					}else{
					echo '<script>
							swal({
								type: "error",
								title: "¡Completa ambos campos!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

							});

						 </script>';

					}
				}else{
					echo '<script>
							swal({
								type: "error",
								title: "¡Password actual invalido!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

							});

						 </script>';
				}

			}
		}

		public function ctrSubirBaseAsesores(){
			if(isset($_FILES["nuevoArchivoAsesores"]["tmp_name"])){

				$FECHA = date('Y-m-d');
				$HORA = date('H-i-s');
				$EMP = $_SESSION["numemp"];
				$PLAZA = $_SESSION["idPlaza"];
				$tabla = "control_asistencias";
				$ruta = "vistas/archivos/altaasesores/".$FECHA."_".$HORA."_".$EMP."_".$PLAZA.".csv";
				$tipoArchivo = "";

				if($_FILES["nuevoArchivoAsesores"]["type"] == "application/vnd.ms-excel"){

					$tipoArchivo = "csv";

					$tmp_archivo = $_FILES["nuevoArchivoAsesores"]["tmp_name"];
					move_uploaded_file($tmp_archivo, $ruta);

				}
				$tabla = "usuario";

				$item1 = "numemp";
				$item2 = "id_checador";

				$item3 = "nombre_completo";
				$item4 = "campana";
				$item5 = "turno";
				$item6 = "plaza";
				$item7 = "nivel_acceso";
				$item8 = "password";
				$item9 = "status_usuario";
				$item10 = "supervisor";

				$cargaExitosa = true;
				$bucle = 0;


				$passwordDefault = "atel";
				$passwordDefaultEncriptado = md5($passwordDefault);

				$plaza = $_SESSION["idPlaza"];
				$nivel = 5;
				$password = $passwordDefaultEncriptado;
				$status = 1;
				$registrosCARGADOS = 0;
				switch($tipoArchivo)
				{
					case "csv":
							if (file_exists($ruta))
							{
								$gestor = fopen($ruta, "r");
								$encabezado = fgetcsv($gestor, 1000, ",");
								$registrosTOTALES = 0;
								$registrosCARGADOS = 0;
								// fclose($gestor);
							    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
							    	$bucle++;
							    	$registrosTOTALES++;

							        $columnaNumEmp = 0;
							        $columnaIdChecador = 1;

							        $columnaNombres = 2;

							        $columnaTurno = 3;
							        $columnaSupervisor = 4;



									$numEmp = $datos[$columnaNumEmp];
									$IdChecador = $datos[$columnaIdChecador];

									$nombres = utf8_encode($datos[$columnaNombres]);

									$turno = $datos[$columnaTurno];
									$supervisor = $datos[$columnaSupervisor];

									$campañaAsesor = ModeloSupervisores::mdlMostrarSupervisor("supervisor", "id", $supervisor);

									// $fecha = date('Y-m-d', strtotime($FECHA_COMPLETA)); // => 2013-02-16
									// $hora = date("H:i",  strtotime($FECHA_COMPLETA));

									$campaña = $campañaAsesor["campana"];

									$respuesta = ModeloUsuarios::mdlIngresarUsuarioPorArchivo($tabla, $item1, $numEmp, $item2, $IdChecador, $item3, $nombres, $item4, $campaña, $item5, $turno, $item6, $plaza, $item7, $nivel, $item8, $password, $item9, $status, $item10, $supervisor);
									$ar = fopen("ejemploAltaFinal.txt", "w");
									fwrite($ar, $respuesta);
									fclose($ar);
									if($respuesta == "ok")
									{
										$registrosCARGADOS+=1;
									}

							      }
							     fclose($gestor);

							   	echo '<script>
										swal({
											type: "success",
											title: "¡Se cargaron '.$registrosCARGADOS.' registros de '.$registrosTOTALES.' totales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "asesoresNominas";
											}
										});
									 </script>';
									}

					break;
				}

			}
		}


		public function ctrSubirBaseBajaAsesores(){
			if(isset($_FILES["nuevoArchivoBajaAsesores"]["tmp_name"])){

				$FECHA = date('Y-m-d');
				$HORA = date('H-i-s');
				$EMP = $_SESSION["numemp"];
				$PLAZA = $_SESSION["idPlaza"];
				$tabla = "control_asistencias";
				$ruta = "vistas/archivos/altaasesores/".$FECHA."_".$HORA."_".$EMP."_".$PLAZA.".csv";
				$tipoArchivo = "";

				if($_FILES["nuevoArchivoBajaAsesores"]["type"] == "application/vnd.ms-excel"){

					$tipoArchivo = "csv";

					$tmp_archivo = $_FILES["nuevoArchivoBajaAsesores"]["tmp_name"];
					move_uploaded_file($tmp_archivo, $ruta);

				}
				$tabla = "usuario";

				$item1 = "status_usuario";
				$valor1 = 0;
				$item2 = "numemp";

				$cargaExitosa = true;
				$bucle = 0;

				switch($tipoArchivo)
				{
					case "csv":
							if (file_exists($ruta))
							{
								$gestor = fopen($ruta, "r");
								$encabezado = fgetcsv($gestor, 1000, ",");
								$registrosTOTALES = 0;
								$registrosCARGADOS = 0;
								// fclose($gestor);
							    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
							    	$bucle++;
							    	$registrosTOTALES++;

							        $columnaNumEmp = 0;



									$numEmp = $datos[$columnaNumEmp];

									$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $numEmp);
									if($respuesta == "ok")
									{
										$registrosCARGADOS++;
									}

							      }
							     fclose($gestor);

							   	echo '<script>
										swal({
											type: "success",
											title: "¡Se cargaron '.$respuesta[2].' registros de '.$registrosTOTALES.' totales!",
											showConfirmbutton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false
										}).then(function(result){
											if(result.value){
												window.location = "asesoresNominas";
											}
										});
									 </script>';
									}

					break;
				}

			}
		}

		static public function ctrDescargarActivos(){

			if(isset($_POST["descargar"])){
				$tabla = "usuario";

				$item1 = "plaza";
				$valor1 = $_SESSION["idPlaza"];
				$item2 = "status_usuario";
				$valor2 = "1";
				$item3 = "nivel_acceso";
				$valor3 = 5;

				$respuesta = ModeloUsuarios::mdlMostrarUsuariosActivos($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

				$fechaRecuperacion = date('__Y_m_d__H_i_s');

				$nombreArchivo = "vistas/archivos/reportes/Reporte de activos al ".$fechaRecuperacion."__".$_SESSION["numemp"].".csv";

				$archivoReporte = fopen($nombreArchivo, "w");

				fwrite($archivoReporte, "numemp, id_checador, nombre, plaza,".utf8_decode("campaña").", turno, supervisor, status".PHP_EOL);

				foreach ($respuesta as $key => $value) {



					$plaza = ControladorPlazas::ctrMostrarPlaza("id", $value["plaza"]);
					$supervisor = ControladorSupervisores::ctrMostrarSupervisor("id",$value["supervisor"] );
					$turno = ControladorTurnos::ctrMostrarTurno("id", $value["turno"]);
					$campaña = ControladorCampañas::ctrMostrarCampaña("id", $value["campana"]);
					$nombre = utf8_decode($datosSolicita["nombre_completo"]);
					$super = utf8_decode($supervisor["nombre"])." ".utf8_decode($supervisor["apellido_paterno"])." ".utf8_decode($supervisor["apellido_materno"]);

					switch($value["status_usuario"]){
						case 1: $status = "activo";break;
						default: $status = "baja"; break;
					}



					fwrite($archivoReporte, $value["numemp"].",".$value["id_checador"].",".$value["nombre_completo"].",".$plaza["nombre"].",".$campaña["campana"].",".$turno["horario_entrada"]." - ".$turno["horario_salida"].",".$super.",".$status.PHP_EOL);
				}

				fclose($archivoReporte);
				echo '<script>window.open("http://189.198.135.118/mi_atel/'.$nombreArchivo.'")</script>';


			}

		}


	}

?>
