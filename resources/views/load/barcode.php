<center>
<?php                                
    $phpVar = $_GET['id'];
    echo QrCode::size(300)->generate($phpVar);
?>
</center>