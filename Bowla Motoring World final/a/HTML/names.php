<?php
include 'config.php';
if(!empty($_POST["keyword"])) {
$query =$db->prepare("SELECT * FROM product WHERE Name like '" . $_POST["keyword"] . "%' ORDER BY Name LIMIT 0,6");
$query->execute();

if(!empty($query)) {
?>
<ul id="partlist">
<?php
foreach($query as $r) {
?>
<li style=list-style:none; onClick="selectPart('<?php echo $r['Name']; ?>');"><?php echo $r['Name']; ?></li>
<?php } ?>
</ul>
<?php } } ?>


