<html>
<head>
	<title>Faradila Intan Osykawati - 202101079 UTS Pemrograman Web</title>
</head>
<body>
	<!-- input -->
	<form method="post" style="border: 2px solid blue;padding: 50px;">
		<h1 align="center" style="margin: 0px;margin-bottom: 50px;">Uts Pemrograman Web</h1>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<input type="text" name="nama" required>
				</td>
				<td style="padding-left: 50px;"></td>
				<td>Lama</td>
				<td>:</td>
				<td>
					<input type="number" name="lama" required>
				</td>
				<td> Hari</td>
			</tr>
			<tr>
				<td>Kode Booking</td>
				<td>:</td>
				<td>
					<select name="kode" required style="width: 100%">
						<option value=""></option>
						<option value="AL02102">AL02102</option>
						<option value="BG03025">BG03025</option>
						<option value="CR02111">CR02111</option>
						<option value="KM03075">KM03075</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td>	
					<input type="number" name="jumlah" required>
				</td>
				<td>Orang</td>
				<td>Jenis Pembayaran</td>
				<td>:</td>
				<td>
					<select name="bayar" required="">
						<option value=""></option>
						<option value="Kartu Kredit">Kartu Kredit</option>
						<option value="Debit">Debit</option>
						<option value="Cash">Cash</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<button type="submit" name="simpan" value="simpan" style="width: 40%;">Proses</button>
					<button type="reset" style="width: 40%;">Hapus</button>
				</td>
			</tr>
		</table>
	</form>

	<!-- output -->
	<?php if (isset($_POST['simpan'])): ?>
		<?php
			$data = generateInfoKamar($_POST);
		?>
		<div style="border: 2px solid blue;padding-bottom: 30px;padding: 50px;">
			<h1 align="center">FLORENSIA HOTEL</h1>
			<table style="width: 100%;">
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><?= $_POST['nama'] ?></td>
					<td>Kode Booking</td>
					<td>:</td>
					<td><?= $_POST['kode'] ?></td>
				</tr>
				<tr>
					<td>Nama Kamar</td>
					<td>:</td>
					<td><?= $data['name'] ?></td>
					<td>Lantai</td>
					<td>:</td>
					<td><?= $data['lantai'] ?></td>
				</tr>
				<tr>
					<td>Nomor</td>
					<td>:</td>
					<td><?= $data['nomor'] ?></td>
					<td>Jumlah</td>
					<td>:</td>
					<td><?= $_POST['jumlah'] ?> Orang</td>
				</tr>
				<tr>
					<td>Lama</td>
					<td>:</td>
					<td><?= $_POST['lama'] ?> Hari</td>
					<td>Jenis Pembayaran</td>
					<td>:</td>
					<td><?= $_POST['bayar'] ?></td>
				</tr>
				<tr>
					<td>Potongan / Tambahan</td>
					<td>:</td>
					<td><?= $data['tambahan'] ?></td>
					<td>Biaya Spring Bad Tambahan</td>
					<td>:</td>
					<td><?= $data['springbed'] ?></td>
				</tr>
				<tr>
					<td>Total Biaya Seluruhnya</td>
					<td>:</td>
					<td>Rp <?= ($data['total'] + $data['tambahan']) * $_POST['lama'] ?></td>
				</tr>
			</table>
		</div>
	<?php endif ?>
</body>
</html>

<?php
function generateInfoKamar($data) {
	$kd = substr($data['kode'], 0, 2);
	$lantai = substr($data['kode'], 2, 2);
	$nomor = substr($data['kode'], 4, 3);
	$kamar = [
		'AL' => [
			'name' => 'Alamanda',
			'price' => 450000
		],
		'BG' => [
			'name' => 'Bougenvile',
			'price' => 350000
		],
		'CR' => [
			'name' => 'Crysan',
			'price' => 375000
		],
		'KM' => [
			'name' => 'Kemuning',
			'price' => 425000
		],
	];
	
	$total = $kamar[$kd]['price'];
	$tambahan = 0;
	$springbed = 0;
	if ($data['jumlah'] > 2) {
		$springbed = $data['jumlah'] * 75000;
		$tambahan = $springbed;
	}
	if ($data['bayar'] == "Kartu Kredit") {
		$tambahan += ($total + $tambahan) * 2 / 100;
	} elseif ($data['bayar'] == "Debit") {
		$tambahan -= ($total + $tambahan) * 1.5 / 100;
	}

	return [
		'name' => $kamar[$kd]['name'],
		'price' => $kamar[$kd]['price'],
		'lantai' => $lantai,
		'nomor' => $nomor,
		'tambahan' => $tambahan,
		'springbed' => $springbed,
		'total' => $total
	];
}
?>