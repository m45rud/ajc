<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

        $id_user = $_REQUEST['id_user'];
		$level = $_REQUEST['level'];

        if($id_user == 1){
            header("location: ./admin.php?hlm=user");
            die();
        }

		$sql = mysqli_query($koneksi, "UPDATE user SET level='$level' WHERE id_user='$id_user'");

		if($sql == true){
			header('Location: ./admin.php?hlm=user');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_user = $_REQUEST['id_user'];

		$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
		while($row = mysqli_fetch_array($sql)){

?>

<h2>Edit Tipe User</h2>
<hr>

<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
        <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
		<label for="username" class="col-sm-2 control-label">Username</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="username" value="<?php echo $row['username']; ?>" name="username" placeholder="Username" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama User</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" value="<?php echo $row['nama']; ?>" name="nama" placeholder="Nama User" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Jenis User</label>
		<div class="col-sm-3">
			<select name="level" class="form-control" required>
				<option value="<?php echo $row['level']?>">
				<?php
					$level = $row['level'];
					if($level == 1){
						echo 'Admin';
					} else {
						echo 'User Biasa';
					}
				?>
				</option>
				<option value="2">User Biasa</option>
				<option value="1">Admin</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=user" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
    }
	}
}
?>
