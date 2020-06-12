<?php
	
	class ControladorPlazas{

		/*==========================================
		=            INGRESO DE USUARIO            =
		==========================================*/
		
		public function mostrarPlazas(){
			
					
			$tabla = "plaza";
			
			$respuesta = ModeloPlazas::mdlMostrarPlazas($tabla);
			return $respuesta;
			
		}

		public function mostrarPlazasActivas(){
			
					
			$tabla = "plaza";
			
			$respuesta = ModeloPlazas::mdlMostrarPlazasActivas($tabla);
			return $respuesta;
			
		}

		static public function ctrMostrarPlaza($item, $valor){
			
					
			$tabla = "plaza";
			
			$respuesta = ModeloPlazas::mdlMostrarPlaza($tabla, $item, $valor);
			return $respuesta;
			
		}

		static public function ctrActivarPlaza($item1, $valor1, $item2, $valor2){
			$tabla = "plaza";
			$respuesta = ModeloPlazas::mdlActivarPlaza($tabla, $item1, $valor1, $item2, $valor2);
			return $respuesta;
		}

		static public function ctrEditarPlaza(){

			if(isset($_POST["editarPlaza"]))
			{
				
					
						$tabla = "plaza";
						$item1 = "nombre";
						$valor1 = utf8_encode($_POST["editarPlaza"]);
						$item2 = "id";
						$valor2 = $_POST["idPlazaActual"];
						$respuesta = ModeloPlazas::mdlActivarPlaza($tabla, $item1, $valor1, $item2, $valor2);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡La plaza se edito correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "plazasRoot";
								}
							});
							
						 </script>';
						}else{
							echo '<script>
							swal({
								type: "error",
								title: "Error al editar plaza Cod. Err: '.$respuesta[2].'",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "plazasRoot";
								}
							});
							
						 </script>';
						}
					
				
			}

			
			
		}

		static public function ctrAgregarPlaza(){
			if(isset($_POST["nuevaPlaza"]))
			{
				
					
						$tabla = "plaza";
						$nombre = $_POST["nuevaPlaza"];
						$estado = 1;
						$respuesta = ModeloPlazas::mdlAgregarPlaza($tabla, $nombre, $estado);
						if($respuesta == "ok"){
							echo '<script>
							swal({
								type: "success",
								title: "¡La plaza se dio de alta correctamente!",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "plazasRoot";
								}
							});
							
						 </script>';
						}else{
							echo '<script>
							swal({
								type: "error",
								title: "Error al agregar plaza Cod. Err: '.$respuesta[2].'",
								showConfirmbutton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){
								if(result.value){
									window.location = "plazasRoot";
								}
							});
							
						 </script>';
						}
					
				
			}
		}
		
		
	}

?>