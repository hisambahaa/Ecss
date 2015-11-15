<?php echo $_SERVER['DOCUMENT_ROOT'];?>
<?php echo "<br>"; ?>
<?php $x = pathinfo($_SERVER['SCRIPT_FILENAME']); 
$y = $x['dirname'];
echo $y;
?>
<?php echo "<br>"; ?>
<?php echo str_replace($_SERVER['DOCUMENT_RaOOT']."/" , '', $y); ?>