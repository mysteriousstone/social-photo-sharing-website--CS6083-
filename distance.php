<?

 function get_dist($lng1, $lat1, $lng2 ,$lat2)

{
 $r = 6371.137;
$dlat = deg2rad($lat2 - $lat1);
  $dlng = deg2rad($lng2 - $lng1);
    $a = pow(sin($dlat / 2), 2)+cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *pow(sin($dlng / 2), 2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	 return $r * $c;

}

$lat1=$_GET['lat1'];
$lat2=$_GET['lat2'];
$lon1=$_GET['lat1'];
$lon2=$_GET['lat2'];
echo get_dist($lon1, $lat1, $lon2, $lat2);

?>