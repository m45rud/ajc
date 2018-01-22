<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_biaya = $_REQUEST['id_biaya'];

    $sql = mysqli_query($koneksi, "DELETE FROM biaya WHERE id_biaya='$id_biaya'");
    if($sql == true){
        header("Location: ./admin.php?hlm=biaya");
        die();
    }
    }
}
?>
