<?php 
include '../connect/koneksi.php';

	//kondisi di simpan / di edit
if (isset($_POST['bsimpan']))
{
	if ($_GET['hal'] == "edit") 
	{
		$edit = mysqli_query($koneksi, "update tmhs set nim ='$_POST[tnim]',
			nama = '$_POST[tnama]',
			alamat =  '$_POST[talamat]',
			program_studi ='$_POST[tprodi]'
			where id_mhs = '$_GET[id]'
			");
		// jika edit sukses
		if ($edit) {
			echo "<script>
			alert('Edit Data Sukses !!!');
			document.location='main.php';
			</script>";
		} else {
			echo "<script>
			alert('Edit Data GAGAL !!!');
			document.location='../pages/main.php';
			</script>";
		}
	} else
	{
		if (isset($_POST['bsimpan'])) {
			$simpan = mysqli_query($koneksi, "insert into tmhs (nim, nama, alamat, program_studi)
				values ('$_POST[tnim]',
				'$_POST[tnama]',
				'$_POST[talamat]',
				'$_POST[tprodi]')
				");
		// jika simpan sukses
			if ($simpan) {
				echo "<script>
				alert('Simpan Data Sukses !!!');
				document.location='../pages/main.php';
				</script>";
			} else {
				echo "<script>
				alert('Simpan Data GAGAL !!!');
				document.location='../pages/main.php';
				</script>";
			}
		}
	}
}


	//btn edit & hapus
if (isset($_GET['hal'])) 
{
	if ($_GET['hal'] == "edit") 
	{
		$tampil = mysqli_query($koneksi, "select * from tmhs where id_mhs = '$_GET[id]'");
		$data = mysqli_fetch_array($tampil);
		if ($data) {
			$vnim = $data['nim'];
			$vnama = $data['nama'];
			$vnalamat = $data['alamat'];
			$vprodi = $data['program_studi'];
		}
	}
	else if ($_GET['hal'] == "hapus") {
		$hapus = mysqli_query($koneksi, "delete from tmhs where id_mhs = '$_GET[id]'");
		if ($hapus) {
			echo "<script>
			alert('Hapus Data Sukses !!!');
			document.location='../pages/main.php';
			</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tugas Besar Basis Data</title>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.css">
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>	
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand">Database Mahasiswa</a>
		<a href="../pages/logout.php"><button type="button" class="btn btn-outline-dark">Logout</button></a>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-8">
				<div class="card mt-3">
					<div class="card-header bg-success text-white">
						Daftar Mahasiswa
					</div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Program Studi</th>
								<th>Aksi</th>
							</tr>
							<?php 
							$no = 1;
							$tampil = mysqli_query($koneksi, "select * FROM tmhs order by id_mhs desc");
							while ($data = mysqli_fetch_array($tampil)) :

								?>
								<tr>
									<td><?=$no++;?></td>
									<td><?=$data['nim']?></td>
									<td><?=$data['nama']?></td>
									<td><?=$data['alamat']?></td>
									<td><?=$data['program_studi']?></td>
									<td>
										<a href="main.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning">Edit</a>
										<a href="main.php?hal=hapus&id=<?=$data['id_mhs']?>" onclick="return confirm('Apakah yakin ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
									</td>
								</tr>
							<?php endwhile; ?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card mt-3">
					<div class="card-header bg-primary text-white">
						Form Input Data Mahasiswa
					</div>
					<div class="card-body">
						<form method="post" action="">
							<div class="form-group">
								<label>NIM</label>
								<input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Masukan NIM" required>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Masukan Nama" required>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea name="talamat" class="form-control" placeholder="Masukan Alamat" required><?=@$vnalamat?></textarea>
							</div>
							<div class="form-group">
								<label>Program Studi</label>
								<select class="form-control" name="tprodi">
									<option value="<?=@$vprodi?>"><?=@$vprodi?></option>
									<option value="D3-Manajemen Informasi">D3-Manajemen Informasi</option>
									<option value="S1-Manajemen Informasi">S1-Manajemen Informasi</option>
									<option value="S1-Teknik Informatika">S1-Teknik Informatika</option>	
									<option value="S1-Desain Komunikasi Visual">S1-Desain Komunikasi Visual</option>
									<option value="S1-Sistem Informasi">S1-Sistem Informasi</option>
									<option value="S1-Akutansi">S1-Akutansi</option>		
									<option value="S1-Manajemen">S1-Manajemen</option>		
								</select>
							</div>
							<button type="sumbit" class="btn btn-success" name="bsimpan">Simpan</button>
							<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
						</form>
					</div>
				</div>
			</div>


		</div>		
	</div>

	<script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>