<center>
<?php                                
    $phpVar = $id;
    echo QrCode::size(300)->generate($phpVar);
?>
</center>