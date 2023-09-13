<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
    
    ob_start();
    
    require '../class/function/curl_api.php';

    require '../class/function/function.php';

    $codigo  = trim($_GET['codigo']);
  
  
    $dataJSON = json_encode(
        array(
            'codigo'            => $codigo
          
        ));
        
$result	= get_curl('operacion/obtenercliente', $dataJSON);
   $result = get_curl('operacion/obtenercliente/' . $codigo);

 /*  echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>

</tr>";
while($result = json_encode($result)) {
  echo "<tr>";
  echo "<td>" . $result[0] . "</td>";
  echo "<td>" . $result[1] . "</td>";
 
  echo "</tr>";
}
echo "</table>";*/
 

if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];
	$listaRoles = get_curl('operacion/roles');
	$solicitudJSON2 = get_curl('operacion/obtenercliente/' . $codigo);
  
}

if ($solicitudJSON2 != null || $solicitudJSON2 != "") {
  foreach ($solicitudJSON2['data'] as $key => $value) {
    if (isset($value['codigo'])) {
?>

<?php
    }
  }
}

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Lastname</th>

</tr>";
if($result = json_encode($result)) {
  echo "<tr>";
  echo "<td>" . $value['sexo'] . "</td>";
  echo "<td id='td2'>" . $value['ciudad'] . "</td>";
  echo "<td id='td'>" . $value['BARRIO'] . "</td>";

  echo "</tr>";
}
echo "</table>";




   
?>