<?php 

	  //http://geojson.io/#map=11/13.6150/-88.2339
	  //https://wtools.io/convert-json-to-php-array
	  
	  # conectare la base de datos
	  $db_host="localhost";
	  $db_user="rootsec";
	  $db_pass="123456789";
	  $db_name="test_marcadores";
    $con=@mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$sql="select * from direcciones";
	$query=mysqli_query($con,$sql);
	$features = [];
	$i=0;
	while($row=mysqli_fetch_array($query)){
		 $lat=$row['latitud'];
	    $long=$row['longitud'];
		$propiedades1=array ('title'=> $row['ciudad'],'description'=> $row['direccion']);
		$arreglo_datos=array ('type' => 'Feature','properties' => $propiedades1,'geometry' =>  array ('type' => 'Point','coordinates' => array (0 => $long,1 => $lat)));
        $features += ["$i" =>$arreglo_datos ];
		$i++;
	}

	  
	  

$array_multi=$features;
$data=
array ('type' => 'FeatureCollection','features' => $features);

echo json_encode($data);