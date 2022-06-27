<?php
error_reporting(E_ALL & ~E_NOTICE);


$arr = [];
for($i = 1;$i <= 10; $i++) {
	$arr[] = $i;
}

$br = 0;
for($j = 0; $j < count($arr); $j++) {
	for($v = $j; $v >= 0; $v--) {
		echo $arr[$br++];
	}
	echo "<br>";
}

/* 2 */
$arr = [
// 1, 2, 3, ,4, 5,6, 7
	[1, 2, 3, 4, 5, 6, 7], // 1
	[11, 2, 3, 4, 5, 6, 7], // 2
	[1, 2, 3, 4, 5, 6, 7], // 3
	[1, 2, 3, 4, 5, 6, 7], // 4
	[1, 2, 3, 4, 5, 6, 7], // 5
];
$res = [];

foreach ($arr as $f) {
	$cnt = 0;
	foreach ($f as $k => $v) {
		$cnt += $f[$k];
	}
	$res['row'][] = $cnt;
}

foreach ($arr as $f) {
	foreach ($f as $k => $v) {
		$res['col'][$k] += $v;
	}
}

var_dump($res);



/* 3 */


$cities = [
	'Montreal' => '24.48.0.1',
	'Vinnica' => '91.236.249.241',
	'Kaluga' => '185.135.149.250',
];


function getPhone($ip)
{
	$ch = curl_init('http://ip-api.com/json/' . $ip . '?lang=ru');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$res = curl_exec($ch);
	curl_close($ch);

	$res = json_decode($res, true);
	echo '<pre>';
	var_dump($res);
	return $res['city'];
}


//status' => string 'success' (length=7)
//  'country' => string 'Украина' (length=14)
//  'countryCode' => string 'UA' (length=2)
//  'region' => string '05' (length=2)
//  'regionName' => string 'Винницкая область' (length=33)
//  'city' => string 'Винница' (length=14)
//  'zip' => string '21000' (length=5)
//  'lat' => float 49.2335
//  'lon' => float 28.4817
//  'timezone' => string 'Europe/Kiev' (length=11)
//  'isp' => string 'IP-Connect LLC' (length=14)
//  'org' => string 'TM-node' (length=7)
//  'as' => string 'AS57944 IP-Connect LLC' (length=22)
//  'query' => string '91.236.249.241' (length=14)
//var_dump(getPhone('91.236.249.241'));


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta
		name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
	>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>

<select name="" id="">
	<option value=""></option>
	<?php foreach ($cities as $k => $v) : ?>
		<option value="<?= $v; ?>">
			<?= $k; ?>
		</option>
	<?php endforeach; ?>
</select>

<div>
	<p class="city">your city is <span></span></p>
	<p class="phone">Phone: 8-800-<span></span></p>
</div>

<script>
	const sel = document.querySelector("select");
	const city = document.querySelector("div .city span");
	const phone = document.querySelector("div .phone span");
	const phones = [
		{ ip: "24.48.0.1", cPhone: "montreal phone" },
		{ ip: "91.236.249.241", cPhone: "vinnica phone" },
		{ ip: "185.135.149.250", cPhone: "kaluga phone" }
	];
	sel.addEventListener("change", e => {
		const Tcity = e.target.options[sel.selectedIndex].textContent.trim()

		const ip = e.target.value;
		const assa = phones.filter(item => {
			return item.ip == ip;
		});
		let {cPhone} = assa[0];
		phone.innerText = cPhone;
		city.innerText = Tcity;
	});
</script>

</body>
</html>
