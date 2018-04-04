<?php 
// Our sample array
$foo = array(
  'number'  => 1,
  'float'   => 1.5,
  'array'   => array(1,2),
  'string'  => 'bar',
  'function'=> 'function(){return "foo bar";}'
);


// Now encode the array to json format
$json = json_encode($foo,JSON_UNESCAPED_UNICODE);
// Send to to the client
echo $json ;


?>