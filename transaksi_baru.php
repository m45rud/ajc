<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$no_nota = $_REQUEST['no_nota'];
		$jenis = $_REQUEST['jenis'];
		$nama = $_REQUEST['nama'];
		$bayar = $_REQUEST['bayar'];
		$kembali = $_REQUEST['kembali'];
		$total = $_REQUEST['total'];
		$id_user = $_SESSION['id_user'];

		$sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_nota, jenis, nama, bayar, kembali, total, tanggal, id_user) VALUES('$no_nota', '$jenis', '$nama', '$bayar', '$kembali', '$total', NOW(), '$id_user')");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Transaksi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">

		<?php

			$sql = mysqli_query($koneksi, "SELECT no_nota FROM transaksi");
				echo '<input type="text" class="form-control" id="no_nota" value="';

			$no_nota = "C001";
			if(mysqli_num_rows($sql) == 0){
				echo $no_nota;
			}

			$result = mysqli_num_rows($sql);
			$counter = 0;
			while(list($no_nota) = mysqli_fetch_array($sql)){
				if (++$counter == $result) {
					$no_nota++;
					echo $no_nota;
				}
			}
				echo '"name="no_nota" placeholder="No. Nota" readonly>';

		?>

		</div>
	</div>
	<div class="form-group">
<script>

  $(document).ready(function(){ /* PREPARE THE SCRIPT */

    $("#jenis").change(function(){ /* TRIGGER THIS WHEN USER HAS SELECTED DATA FROM THE SELECT FIELD */

      var jenis = $(this).val(); /* STORE THE SELECTED LOAD NUMBER TO THIS VARIABLE */

      $.ajax({ /* START AJAX */

        type: "POST", /* METHOD TO USE TO PASS THE DATA */
        url: "action.php", /* THE FILE WHERE WE WILL PASS THE DATA */
        data: {"jenis": jenis}, /* THE DATA WE WILL PASS TO action.php */
        dataType: 'json', /* DATA TYPE THAT WILL BE RETURNED FROM action.php */
        success: function(result){
          /* PUT CORRESPONDING RETURNED DATA FROM action.php TO THESE TWO TEXTBOXES */
          $("#biaya").val(result.biaya);
        }

      }); /* END OF AJAX */

    }); /* END OF CHANGE #loads */

  });

</script>
		<label for="jenis" class="col-sm-2 control-label">Jenis Kendaraan</label>
		<div class="col-sm-3">
			<select name="jenis" class="form-control" id="jenis" required>
				<option value="" disable>--- Pilih Jenis Kendaraan ---</option>
			<?php

				$q = mysqli_query($koneksi, "SELECT jenis FROM biaya");
				while(list($jenis) = mysqli_fetch_array($q)){
					echo '<option value="'.$jenis.'">'.$jenis.'</option>';
				}

			?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Biaya</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" name="biaya" value="" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bayar" class="col-sm-2 control-label">Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="bayar" name="bayar" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kembali" class="col-sm-2 control-label">Kembalian</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="kembali" name="kembali" placeholder="Kembalian" required>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="col-sm-2 control-label">Total Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="total" name="total" placeholder="Total Bayar" required>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Pelanggan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
