<?php
global $wpdb;

$tanaaeg = new DateTime('today');
$tanadate = substr($tanaaeg->format('Y-m-d'), 0,10);
$tana_kuupaev = substr($tanadate, 5, 5);

$hommedate = date('Y-m-d', strtotime("+1 day", strtotime($tanadate)));
$homme_kuupaev = substr($hommedate, 5, 5);

$juubeldate = date('Y-m-d', strtotime("+1 month", strtotime($tanadate)));
$juubel_kuupaev = substr($juubeldate, 5, 5);

$aasta = substr($tanadate, 0, 4);

$isikud = $wpdb->prefix . 'isikud';

$isikute_andmed = $wpdb->get_results("SELECT * FROM $isikud");

$maingrupp = array();
$saajad = array();

foreach ($isikute_andmed as $andmed){
	$kuupaev = $andmed->kuupaev;
	$iluskuupaev = date('d.m.Y', strtotime($kuupaev));
	$eesnimi = $andmed->eesnimi;
	$perenimi = $andmed->perenimi;
	$email = $andmed->email;
	$saaja_email = $andmed->saaja_email;
	$aktiivne = $andmed->aktiivne;
	$grupi_id = $andmed->grupi_id;
	
	$saajagrupp = $wpdb->get_results("SELECT uldmeil, struktuuri_id from $grupid WHERE id=$grupi_id");
	$saajagrupp = $saajagrupp[0];	
	$saajameil = $saajagrupp->uldmeil;
	$struktuuri_id = $saajagrupp->struktuuri_id;


	$grupi_nimi = 'grupp' . $grupi_id;
	$nimi = $eesnimi . ' ' . $perenimi;
	$tana = 'Tana' . $grupi_id;
	$homme = 'Homme' . $grupi_id;
	$juubel = 'Juubel' . $grupi_id;
	
	$sunni_kuupaev = substr($kuupaev, 5, 5);
	$sunni_aasta = substr($kuupaev, 0, 4);
	
	$info = array(
					'nimi' => $nimi,
					'email' => $email,
					'struktuuri_id' => $struktuuri_id,
					'kuupaev' => $iluskuupaev
	);
	
	//TÄNA SÜNNIPÄEV
	if($tana_kuupaev == $sunni_kuupaev){
		if($aktiivne == 'Jah'){
			$maingrupp = uldmeilile($tana, $grupi_nimi, $saajameil, $maingrupp, $info);
		}
		if($saaja_email != ''){
			$saajad = erameilile($tana, $saaja_email, $saajad, $info);
		}
	}
	//HOMME SÜNNIPÄEV
	else if($homme_kuupaev == $sunni_kuupaev){
		if($aktiivne == 'Jah'){
			$maingrupp = uldmeilile($homme, $grupi_nimi, $saajameil, $maingrupp, $info);
		}
		if($saaja_email != ''){
			$saajad = erameilile($homme, $saaja_email, $saajad, $info);
		}
	}
	//JUUBEL
	else if($juubel_kuupaev == $sunni_kuupaev && (intval($aasta) - intval($sunni_aasta)) % 5 == 0){
		if($aktiivne == 'Jah'){
			$maingrupp = uldmeilile($juubel, $grupi_nimi, $saajameil, $maingrupp, $info);
		}
		if($saaja_email != ''){
			$saajad = erameilile($juubel, $saaja_email, $saajad, $info);
		}
	}
}

function uldmeilile($paev, $grupi_nimi, $saajameil, $maingrupp, $info){

	if (!array_key_exists($grupi_nimi, $maingrupp)){
		$maingrupp[$grupi_nimi]['uldmeil'] = $saajameil;
	}
	
	$arv = 1;
	
	if(array_key_exists($paev, $maingrupp[$grupi_nimi])){
		$arv = count($maingrupp[$grupi_nimi][$paev]) + 1;
	}
	
	$maingrupp[$grupi_nimi][$paev]['isik' . $arv] = $info;

	return $maingrupp;
}

function erameilile($paev, $saaja_email, $saajad, $info){
	$arv = 1;
	
	if(array_key_exists($saaja_email, $saajad) && array_key_exists($paev, $saajad[$saaja_email])){
		$arv = count($saajad[$saaja_email][$paev]) + 1;
	}
	
	$saajad[$saaja_email][$paev]['isik' . $arv] =  $info;

	return $saajad;
}

foreach(array_keys($maingrupp) as $grupi_nimi){
	$sonum = "";
	$sonum = $sonum . '<br>Lp. <a href="mailto:' . $maingrupp[$grupi_nimi]['uldmeil'] . '">' . $maingrupp[$grupi_nimi]['uldmeil'] . '</a>!<br>Ära unusta sünnipäevi!<br><br>';
	foreach(array_keys($maingrupp[$grupi_nimi]) as $paev){
		if($paev != 'uldmeil'){
			if(substr($paev, 0, 4) == 'Tana'){
				$sonum = $sonum . 'Täna: ';
			}
			else if(substr($paev, 0, 5) == 'Homme'){
				$sonum = $sonum . 'Homme: ';
			}
			else{
				$sonum = $sonum . 'Juubel tulekul: ';
			}
			foreach($maingrupp[$grupi_nimi][$paev] as $isik){
				$sonum = $sonum . $isik['nimi'] . ' (' . $isik['kuupaev'] . '), email: <a href="mailto:' . $isik['email'] . '">' . $isik['email'] . '</a><br>';	
			}
		}
	}
	$to = 'eleriinr@ut.ee'; //$to = $maingrupp[$grupi_nimi]['uldmeil'];
	$subject = 'Tähtis meil';

	$result = wp_mail( $to, $subject, $sonum );
	echo $result;
}

foreach(array_keys($saajad) as $saaja){
	$sonum = "";
	$sonum = $sonum . '<br>Lp. <a href="mailto:' . $saaja . '">' . $saaja . '</a>!<br>Ära unusta sünnipäevi!<br><br>';
	foreach(array_keys($saajad[$saaja]) as $paev) {
		if(substr($paev, 0, 4) == 'Tana'){
			$sonum = $sonum . 'Täna: ';
		}
		else if(substr($paev, 0, 5) == 'Homme'){
			$sonum = $sonum . 'Homme: ';
		}
		else{
			$sonum = $sonum . 'Juubel tulekul: ';
		}
		foreach($saajad[$saaja][$paev] as $isik){
			$sonum = $sonum . $isik['nimi'] . ' (' . $isik['kuupaev'] . '), Osakond: ' . $isik['struktuuri_id'] . ', email: <a href="mailto:' . $isik['email'] . '">' . $isik['email'] . '</a><br>';	
		}
	}
	$to = 'eleriinr@ut.ee'; //$to = $saaja;
	$subject = 'Tähtis meil';

	$result = wp_mail( $to, $subject, $sonum );
	echo $result;
}
?>