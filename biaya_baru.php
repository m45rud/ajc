<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$jenis = $_REQUEST['jenis'];
		$biaya = $_REQUEST['biaya'];

		$sql = mysqli_query($koneksi, "INSERT INTO biaya(jenis, biaya) VALUES('$jenis', '$biaya')");

		if($sql == true){
			header('Location: ./admin.php?hlm=biaya');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Data Master biaya Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Jenis Kendaraan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Kendaraan" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Biaya Jasa</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" name="biaya" placeholder="Biaya Jasa" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=biaya" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
