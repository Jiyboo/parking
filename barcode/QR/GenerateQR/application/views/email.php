<html>
<head>
	<meta charset="UTF-8">
	<title><?=$title ?></title>
</head>
<body>
	<?= form_open('EmailTrial/SendMail') ?>

	<table>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type="email" name="email" placeholder="Email Anda.."></td>
		</tr>
		<tr>
			<td>Subject</td>
			<td>:</td>
			<td><input type="text" name="subject" placeholder="Subject Email.."></td>
		</tr>
		<tr>
			<td>Pesan</td>
			<td>:</td>
			<td><textarea name="pesan" cols="30" rows="10" placeholder="Pesan Email.."></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" name="submit_email" value="KIRIM EMAIL"></td>
		</tr>
	</table>
	<?= form_close() ?>
</body>
</html>