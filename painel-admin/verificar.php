<?php
@session_start();
    if(@$_SESSION['nivel_usuario'] != 'bispo' and @$_SESSION['nivel_usuario'] != 'frade'){
        echo "<script>window.location='../index.php'</script>";
    };
?>