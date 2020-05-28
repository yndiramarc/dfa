<?php
	// /**
	// *  Definición de la interfaz 'Sistema de Registro y Estadisticas de Participantes'.
	// *
	// *  Permite registrar, confirmar, listar, exportar e imprimir la entrada al evento de los participantes.
	// *
	// *  @author Jonatha Solorzano <jonathasolorzano@gmail.com>
	// *  @license http://www.gnu.org/licenses/gpl.html
	// *	 GNU General Public License
	// *  @copyright Copyright (c) 2014, FUNDACITE Sucre
	// * 
	// *  @version 2015.04.27
	// */

	$action = $_REQUEST["action"];
	$params = $_POST;
	$estadistica = array();

	switch ($action) {

		case 'consultar':
			$cedula = $_POST["cedula"];

			$conect = mysql_connect("localhost","root","852");

			mysql_select_db("registro-foro2",$conect);
			$sql = "SELECT * FROM registro2 WHERE cedula = '$cedula'";
			$result = mysql_query($sql);
			$return = mysql_fetch_array ($result);
			print json_encode($return);
		break;

		case 'confirmar':
			$cedula = $_POST["cedula"];
			$dias = $_POST["dias"];

			$conect = mysql_connect("localhost","root","852");

			mysql_select_db("registro-foro2",$conect);
			// conectar();

			$sql = "UPDATE registro2 SET dias = '$dias' WHERE cedula = '$cedula'";
			$result = mysql_query($sql);

			if(!$result){                    
				print '{"success": false, "message": "Error al guardar en la tabla: participante."}';
				return;
			}
			print '{"success": true, "message": "Registro guardado con éxito."}';
		break;
		
		/*default:
			# code...
		break;*/
	}
?>