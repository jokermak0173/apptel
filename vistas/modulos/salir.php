<?php
	
	session_destroy();
	$item1 = "numemp";
	$valor1 = $_SESSION["numemp"];
								
	$item2 = "status_sesion";
	$valor2 = "0";

	$item3 = "ip_pc";
	$valor3 = "";

	$item4 = "nombre_pc";
	$valor4 = "";

	$tabla = "usuario";
	$logout = ModeloUsuarios::mdlActualizarLogoutUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4 );
	if($logout == "ok"){
		echo '<script>window.location = "ingreso"</script>';
	}else{
		echo '<script>
				swal({
					type: "error",
					title: "¡No se puede cerrar sesion contactar a sistemas!",
					showConfirmbutton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				})
			 </script>';
	}


?>