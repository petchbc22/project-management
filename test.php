<?php
  include 'appsystem/inc_config.php';

?>
<form action="" method="POST">
<input type="text" name="text">
</form>

<?php
function array_is_unique($array) {
	return array_unique($array) == $array;
 }
 $array = array("a", "a", "b", "c");
echo array_is_unique($array) ? "unique" : "non-unique"; //"non-unique"
?>