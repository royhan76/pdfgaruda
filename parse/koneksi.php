<?php
$konek_db =mysqli_connect('127.0.0.1','root','','grobid1');
if (!$konek_db){
    echo '<script>
                alert(" Maaf Server Sedang Sibuk"); 
                document.location="index.php";
            </script>';
    exit();
}

?>