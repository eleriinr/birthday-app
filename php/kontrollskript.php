<?php
global $wpdb;

$tanaaeg = new DateTime('today');
$tanadate = substr($tanaaeg->format('Y-m-d H:i:s'), 0,10);
$hommedate = date('Y-m-d', strtotime("+1 day", strtotime($tanadate)));
$juubeldate = date('Y-m-d', strtotime("+1 month", strtotime($tanadate)));

$isikud = $wpdb->prefix . 'isikud';

$retrieve_data2 = $wpdb->get_results("SELECT * FROM $isikud");

$aasta = substr($tanadate, 0, 4);
$tana_kuupaev = substr($tanadate, 5, 5);
$homme_kuupaev = substr($hommedate, 5, 5);
$juubel_kuupaev = substr($juubeldate, 5, 5); 

$maingrupp = array();
$saajad = array();

foreach ($retrieve_data2 as $retrieved_data){
	$kuupaev = $retrieved_data->kuupaev;
	$iluskuupaev = substr($kuupaev,8,2) . '.' . substr($kuupaev,5,2) . '.' . substr($kuupaev,0,4);
	$eesnimi = $retrieved_data->eesnimi;
	$perenimi = $retrieved_data->perenimi;
	$email = $retrieved_data->email;
	$saaja_email = $retrieved_data->saaja_email;
	$aktiivne = $retrieved_data->aktiivne;
	$grupi_id = $retrieved_data->grupi_id;
	
	$saajagrupp = $wpdb->get_results("SELECT uldmeil, struktuuri_id from $grupid WHERE id=$grupi_id");
	$saajagrupp = $saajagrupp[0];	
	$saajameil = $saajagrupp->uldmeil;
	$struktuuri_id = $saajagrupp->struktuuri_id;


	$grupi_nimi = 'grupp' . $grupi_id;
	$nimi = $eesnimi . ' ' . $perenimi;
	
	$sunni_kuupaev = substr($kuupaev, 5, 5);
	$sunni_aasta = substr($kuupaev, 0, 4);
	
	//TÄNA SÜNNIPÄEV
	if($tana_kuupaev == $sunni_kuupaev){
		//LÄHEB ÜLDMEILILE
		if($aktiivne == 'Jah'){
			if (!array_key_exists($grupi_nimi, $maingrupp)){
				$alamgrupp1['uldmeil'] = $saajameil;
				
				$tana['isik1'] = array(
										'nimi' => $nimi,
										'email' => $email,
										'kuupaev' => $iluskuupaev
				);
			}
			else if (!array_key_exists('Tana' . $grupi_id, $maingrupp[$grupi_nimi])){
				$alamgrupp1 = $maingrupp[$grupi_nimi];
				$tana['isik1'] = array(
										'nimi' => $nimi,
										'email' => $email,
										'kuupaev' => $iluskuupaev
				);
			}
			else{
				$alamgrupp1 = $maingrupp[$grupi_nimi];
				$tana = $alamgrupp1['Tana' . $grupi_id];
				
				$arv = count($tana) + 1;
				$tana['isik' . $arv] = array(
												'nimi' => $nimi,
												'email' => $email,
												'kuupaev' => $iluskuupaev
				);
			}
				$alamgrupp1['Tana' . $grupi_id] = $tana;	
				$maingrupp[$grupi_nimi] = $alamgrupp1;
		}
		//LÄHEB ERAMEILILE
		if($saaja_email != ''){
			if(!array_key_exists($saaja_email, $saajad)){
				$tana['isik1'] = array(
										'nimi' => $nimi,
										'email' => $email,
										'struktuuri_id' => $struktuuri_id,
										'kuupaev' => $iluskuupaev
				);
				$saajad[$saaja_email]['Tana' . $grupi_id] = $tana;
			}
			else if (!array_key_exists('Tana' . $grupi_id, $saajad[$saaja_email])){
				$saaja = $saajad[$saaja_email];
				$tana['isik1'] = array(
										'nimi' => $nimi,
										'email' => $email,
										'struktuuri_id' => $struktuuri_id,
										'kuupaev' => $iluskuupaev
				);
				$saaja['Tana' . $grupi_id] = $tana;
				$saajad[$saaja_email] = $saaja;
			}
			else{
				$saaja = $saajad[$saaja_email];
				$tana = $saaja['Tana' . $grupi_id];
				
				$arv = count($tana) + 1;
				$tana['isik' . $arv] = array(
												'nimi' => $nimi,
												'email' => $email,
										'struktuuri_id' => $struktuuri_id,
												'kuupaev' => $iluskuupaev
				);
				$saaja['Tana' . $grupi_id] = $tana;
				$saajad[$saaja_email] = $saaja;
			}
		}
	}
	//HOMME SÜNNIPÄEV
	else if($homme_kuupaev == $sunni_kuupaev){
			//LÄHEB ÜLDMEILILE
			if($aktiivne == 'Jah'){
				if (!array_key_exists($grupi_nimi, $maingrupp)){
					$alamgrupp2['uldmeil'] = $saajameil;
					
					$homme['isik1'] = array(
											'nimi' => $nimi,
											'email' => $email,
											'kuupaev' => $iluskuupaev
					);
				}
				else if (!array_key_exists('Homme' . $grupi_id, $maingrupp[$grupi_nimi])){
					$alamgrupp2 = $maingrupp[$grupi_nimi];
					$homme['isik1'] = array(
											'nimi' => $nimi,
											'email' => $email,
											'kuupaev' => $iluskuupaev
					);
				}
				else{
					$alamgrupp2 = $maingrupp[$grupi_nimi];
					$homme = $alamgrupp2['Homme' . $grupi_id];
					
					$arv = count($homme) + 1;
					$homme['isik' . $arv] = array(
													'nimi' => $nimi,
													'email' => $email,
													'kuupaev' => $iluskuupaev
					);
				}
					$alamgrupp2['Homme' . $grupi_id] = $homme;	
					$maingrupp[$grupi_nimi] = $alamgrupp2;
		}
		//LÄHEB ERAMEILILE
		if($saaja_email != ''){
			if(!array_key_exists($saaja_email, $saajad)){
				$homme['isik1'] = array(
										'nimi' => $nimi,
										'email' => $email,
										'struktuuri_id' => $struktuuri_id,
										'kuupaev' => $iluskuupaev
				);
				$saajad[$saaja_email]['Homme' . $grupi_id] = $homme;
			}
			else if (!array_key_exists('Homme' . $grupi_id, $saajad[$saaja_email])){
				$saaja = $saajad[$saaja_email];
				$homme['isik1'] = array(
										'nimi' => $nimi,
										'email' => $email,
										'struktuuri_id' => $struktuuri_id,
										'kuupaev' => $iluskuupaev
				);
				$saaja['Homme' . $grupi_id] = $homme;
				$saajad[$saaja_email] = $saaja;
			}
			else{
				$saaja = $saajad[$saaja_email];
				$homme = $saaja['Homme' . $grupi_id];
				
				$arv = count($homme) + 1;
				$homme['isik' . $arv] = array(
												'nimi' => $nimi,
												'email' => $email,
										'struktuuri_id' => $struktuuri_id,
												'kuupaev' => $iluskuupaev
				);
				$saaja['Homme' . $grupi_id] = $homme;
				$saajad[$saaja_email] = $saaja;
			}
		}
	}
	//JUUBEL
	else if($juubel_kuupaev == $sunni_kuupaev && (intval($aasta) - intval($sunni_aasta)) % 5 == 0){
			//LÄHEB ÜLDMEILILE
			if($aktiivne == 'Jah'){
				if (!array_key_exists($grupi_nimi, $maingrupp)){
					$alamgrupp3['uldmeil'] = $saajameil;
					
					$juubel['isik1'] = array(
												'nimi' => $nimi,
												'email' => $email,
												'kuupaev' => $iluskuupaev
					);
				}
				else if (!array_key_exists('Juubel' . $grupi_id, $maingrupp[$grupi_nimi])){
					$alamgrupp3 = $maingrupp[$grupi_nimi];
					$juubel['isik1'] = array(
												'nimi' => $nimi,
												'email' => $email,
												'kuupaev' => $iluskuupaev
					);
				}
				else{
					$alamgrupp3 = $maingrupp[$grupi_nimi];
					$juubel = $alamgrupp3['Juubel' . $grupi_id];
					
					$arv = count($juubel) + 1;
					$juubel['isik' . $arv] = array(
													'nimi' => $nimi,
													'email' => $email,
													'kuupaev' => $iluskuupaev
					);
				}
					$alamgrupp3['Juubel' . $grupi_id] = $juubel;	
					$maingrupp[$grupi_nimi] = $alamgrupp3;
		}
		//LÄHEB ERAMEILILE
		if($saaja_email != ''){
			if(!array_key_exists($saaja_email, $saajad)){
				$juubel['isik1'] = array(
											'nimi' => $nimi,
											'email' => $email,
										'struktuuri_id' => $struktuuri_id,
											'kuupaev' => $iluskuupaev
				);
				$saajad[$saaja_email]['Juubel' . $grupi_id] = $juubel;
			}
			else if (!array_key_exists('Juubel' . $grupi_id, $saajad[$saaja_email])){
				$saaja = $saajad[$saaja_email];
				$juubel['isik1'] = array(
											'nimi' => $nimi,
											'email' => $email,
										'struktuuri_id' => $struktuuri_id,
											'kuupaev' => $iluskuupaev
				);
				$saaja['Juubel' . $grupi_id] = $juubel;
				$saajad[$saaja_email] = $saaja;
			}
			else{
				$saaja = $saajad[$saaja_email];
				$juubel = $saaja['Juubel' . $grupi_id];
				
				$arv = count($juubel) + 1;
				$juubel['isik' . $arv] = array(
												'nimi' => $nimi,
												'email' => $email,
										'struktuuri_id' => $struktuuri_id,
												'kuupaev' => $iluskuupaev
				);
				$saaja['Juubel' . $grupi_id] = $juubel;
				$saajad[$saaja_email] = $saaja;
			}
		}
	}
}

echo '---------------------------------------------------------------------';
foreach(array_keys($maingrupp) as $grupi_nimi){
	echo '<br><br><br>Lp. <a href="mailto:' . $maingrupp[$grupi_nimi]['uldmeil'] . '">' . $maingrupp[$grupi_nimi]['uldmeil'] . '</a>!<br>Ära unusta sünnipäevi!<br><br>';
	foreach(array_keys($maingrupp[$grupi_nimi]) as $paev){
		if($paev != 'uldmeil'){
			if(substr($paev, 0, 4) == 'Tana'){
				echo 'Täna: ';
			}
			else if(substr($paev, 0, 5) == 'Homme'){
				echo 'Homme: ';
			}
			else{
				echo 'Juubel tulekul: ';
			}
			foreach($maingrupp[$grupi_nimi][$paev] as $isik){
				echo $isik['nimi'] . ' (' . $isik['kuupaev'] . '), email: <a href="mailto:' . $isik['email'] . '">' . $isik['email'] . '</a><br>';	
			}
		}
	}
echo '---------------------------------------------------------------------';
}

foreach(array_keys($saajad) as $saaja){
	echo '<br><br><br>Lp. <a href="mailto:' . $saaja . '">' . $saaja . '</a>!<br>Ära unusta sünnipäevi!<br><br>';
	foreach(array_keys($saajad[$saaja]) as $paev) {
		if(substr($paev, 0, 4) == 'Tana'){
			echo 'Täna: ';
		}
		else if(substr($paev, 0, 5) == 'Homme'){
			echo 'Homme: ';
		}
		else{
			echo 'Juubel tulekul: ';
		}
		foreach($saajad[$saaja][$paev] as $isik){
			echo $isik['nimi'] . ' (' . $isik['kuupaev'] . '), Osakond: ' . $isik['struktuuri_id'] . ', email: <a href="mailto:' . $isik['email'] . '">' . $isik['email'] . '</a><br>';	
		}
	}
}
echo '---------------------------------------------------------------------';
/*
$to = 'eleriinr@ut.ee';
$subject = 'Tähtis meil';
$message = 'hei';

$result = wp_mail( $to, $subject, $message );
echo $result;*/
?>