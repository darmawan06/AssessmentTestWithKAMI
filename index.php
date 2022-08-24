<?php 
	require_once('./ModelPegawai.php');
	require_once('./ModelDivisi.php');
	require_once('./ModelJabatan.php');
	$modelPegawai = new ModelPegawai();
	$modelJabatan = new ModelJabatan();
	$modelDivisi = new ModelDivisi();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tugas CRUD Assesment Test with KAMI</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
	<header class="text-center text-xl">ASSESSMENT TEST with KAMI - Dikdik Darmawan - CRUD SIMPLE - Studi Kasus seperti Soal Back End</header>
	<main class="p-8">
		<section id="selectData" >
			<ul class="grid grid-cols-9 grid-rows-1 gap-4 px-8 bg-blue-200">
				<li class="truncate">
					Nama
				</li>
				<li class="truncate">
					Jenis Kelamin
				</li>
				<li class="truncate">
					Telepon
				</li>
				<li class="truncate">
					Email (unique)
				</li>
				<li class="truncate" >
					Alamat
				</li>
				<li class="truncate">
					Jabatan
				</li>
				<li class="truncate">
					Divisi
				</li>
				<li class="truncate">
					Gaji
				</li>

				<li class="truncate text-center">
					Aksi
				</li>
			</ul>
			<?php foreach ($modelPegawai->selectJoin() as $key => $value) :?>
				<ul class="grid grid-cols-9 grid-rows-1 gap-4 px-8 border border-blue-200">
					<li class="truncate">
						<?= $value['nama_pegawai'] ?>
					</li>
					<li class="truncate">
						<?= $value['jenis_kelamin'] ?>
					</li>
					<li class="truncate">
						<?= $value['telepon_pegawai'] ?>
					</li>
					<li class="truncate">
						<?= $value['email'] ?>
					</li>
					<li class="truncate" >
						<?= $value['alamat'] ?>
					</li>
					<li class="truncate">
						<?= $value['nama_jabatan'] ?>
					</li>
					<li class="truncate">
						<?= $value['nama_divisi'] ?>
					</li>
					<li class="truncate">
						RP. <?= $value['nominal_gaji'] ?>
					</li>
					<li class="truncate flex">
						<a href="ModelPegawai.php?method=delete&id_pegawai=<?= $value['id_pegawai']?>" class="mx-auto bg-red-200 p-2">Delete</a>
						<a href="index.php?id_pegawai=<?= $value['id_pegawai'] ?>" class="mx-auto bg-green-200 p-2">Update</a>
					</li>

				</ul>
			<?php endforeach; ?>
		</section>
		<?php if(isset($_GET['id_pegawai'])) :?>
			<?php 
				$pegawai = mysqli_fetch_array($modelPegawai->find($_GET['id_pegawai']));
			?>
			<form id="inputPegawai" class="grid grid-cols-8 grid-rows-1 gap-4 p-8 bg-blue-200" method="POST" action="ModelPegawai.php?method=update&id_pegawai=<?= $pegawai['id_pegawai'] ?>">
			<div class="flex flex-col">
				<span>Nama</span>
				<input required type="text"  value="<?= $pegawai['nama_pegawai'] ?>" name="name">
			</div>
			<div class="flex flex-col">
				<span>Jenis Kelamin</span>
				<select name="gender">
					<option value="Laki Laki" <?= ($pegawai['jenis_kelamin'] == 'Laki Laki') ? "selected" : ""; ?>>Laki Laki</option>
					<option value="Perempuan" <?= ($pegawai['jenis_kelamin'] == 'Perempuan') ? "selected" : ""; ?>>Perempuan</option>
				</select>
			</div>
			<div class="flex flex-col">
				<span>Telepon</span>
				<input required type="text"  value="<?= $pegawai['telepon_pegawai'] ?>" name="numberphone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
			</div>
			<div class="flex flex-col">
				<span>Email(unique)</span>
				<input required type="email" value="<?= $pegawai['email'] ?>"  name="email">
			</div>
			<div class="flex flex-col">
				<span>Alamat</span>
				<input required type="text"  value="<?= $pegawai['alamat'] ?>" name="address">
			</div>
			<div class="flex flex-col">
				<span>Jabatan</span>
				<select required name="jabatan"> 
						<option value="">Pilih Jabatan</option>
					<?php foreach ($modelJabatan->select() as $key => $value): ?>
						<option value="<?= $value['id_jabatan'] ?>" <?= ($pegawai['jabatan'] == $value['id_jabatan']) ? "selected" : ""; ?>><?= $value['nama_jabatan'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="flex flex-col">
				<span>Divisi</span>
				<select required name="divisi"> 
						<option value="">Pilih Divisi</option>
					<?php foreach ($modelDivisi->select() as $key => $value): ?>
						<option value="<?= $value['id_divisi'] ?>" <?= ($pegawai['divisi'] == $value['id_divisi']) ? "selected" : ""; ?>><?= $value['nama_divisi'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="flex flex-col">
				<span>Kirim</span>
				<input class="bg-yellow-400" type="submit" name="" value="Submit">
			</div>
		</form>
		<?php else : ?>
		<form id="inputPegawai" class="grid grid-cols-8 grid-rows-1 gap-4 p-8 bg-blue-200" method="POST" action="ModelPegawai.php?method=add">
			<div class="flex flex-col">
				<span>Nama</span>
				<input required type="text" name="name">
			</div>
			<div class="flex flex-col">
				<span>Jenis Kelamin</span>
				<select name="gender">
					<option value="Laki Laki">Laki Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
			</div>
			<div class="flex flex-col">
				<span>Telepon</span>
				<input required type="text" name="numberphone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
			</div>
			<div class="flex flex-col">
				<span>Email(unique)</span>
				<input required type="email" name="email">
			</div>
			<div class="flex flex-col">
				<span>Alamat</span>
				<input required type="text" name="address">
			</div>
			<div class="flex flex-col">
				<span>Jabatan</span>
				<select required name="jabatan"> 
						<option value="">Pilih Jabatan</option>
					<?php foreach ($modelJabatan->select() as $key => $value): ?>
						<option value="<?= $value['id_jabatan'] ?>"><?= $value['nama_jabatan'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="flex flex-col">
				<span>Divisi</span>
				<select required name="divisi"> 
						<option value="">Pilih Divisi</option>
					<?php foreach ($modelDivisi->select() as $key => $value): ?>
						<option value="<?= $value['id_divisi'] ?>"><?= $value['nama_divisi'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="flex flex-col">
				<span>Kirim</span>
				<input class="bg-yellow-400" type="submit" name="" value="Submit">
			</div>
		</form>
		<?php endif; ?>

	</main>
	<footer></footer>
</body>
</html>