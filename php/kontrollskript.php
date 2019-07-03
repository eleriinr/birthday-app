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

foreach ($retrieve_data2 as $retrieved_data){
	$kuupaev = $retrieved_data->kuupaev;
	$eesnimi = $retrieved_data->eesnimi;
	$perenimi = $retrieved_data->perenimi;
	$email = $retrieved_data->email;
	$aktiivne = $retrieved_data->aktiivne;
	$grupi_id = $retrieved_data->grupi_id;
	
	$grupi_nimi = 'grupp' . $grupi_id;
	$nimi = $eesnimi . ' ' . $perenimi;
	
	$sunni_kuupaev = substr($kuupaev, 5, 5);
	$sunni_aasta = substr($kuupaev, 0, 4);
	
	if($tana_kuupaev == $sunni_kuupaev && $aktiivne == 'Jah'){
		if (!array_key_exists($grupi_nimi, $maingrupp)){
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saajagrupp = $saajad[0];
			$saajameil = $saajagrupp->uldmeil;
			$alamgrupp['uldmeil'] = $saajameil;
			
			$tana['isik1'] = array('nimi' => $nimi, 'email' => $email);
		
			$alamgrupp['tana'] = $tana;
				
			$maingrupp[$grupi_nimi] = $alamgrupp;
		}
		else if (!array_key_exists('tana', $alamgrupp)){
			$tana['isik1'] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp = $maingrupp[$grupi_nimi];
			
			$alamgrupp['tana'] = $tana;
		}
		else{
			$alamgrupp = $maingrupp[$grupi_nimi];
			
			$tana = $alamgrupp['tana'];
			
			$arv = count($tana) + 1;
			$tana['isik' . $arv] = array('nimi' => $nimi, 'email' => $email);
		}
	}
	else if($homme_kuupaev == $sunni_kuupaev && $aktiivne == 'Jah'){
		if (!array_key_exists($grupi_nimi, $maingrupp)){
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saajagrupp = $saajad[0];
			$saajameil = $saajagrupp->uldmeil;
			$alamgrupp['uldmeil'] = $saajameil;
			
			$homme['isik1'] = array('nimi' => $nimi, 'email' => $email);
		
			$alamgrupp['homme'] = $homme;
				
			$maingrupp[$grupi_nimi] = $alamgrupp;
		}
		else if (!array_key_exists('homme', $alamgrupp)){
			$homme['isik1'] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp = $maingrupp[$grupi_nimi];
			
			$alamgrupp['homme'] = $homme;
		}
		else{
			$alamgrupp = $maingrupp[$grupi_nimi];
			
			$homme = $alamgrupp['homme'];
			
			$arv = count($homme) + 1;
			$homme['isik' . $arv] = array('nimi' => $nimi, 'email' => $email);
		}
	}
	else if($juubel_kuupaev == $sunni_kuupaev && (intval($aasta) - intval($sunni_aasta))%5 == 0 && $aktiivne == 'Jah'){		
		if (!array_key_exists($grupi_nimi, $maingrupp)){
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saajagrupp = $saajad[0];
			$saajameil = $saajagrupp->uldmeil;
			$alamgrupp['uldmeil'] = $saajameil;
			
			$juubel['isik1'] = array('nimi' => $nimi, 'email' => $email);
		
			$alamgrupp['juubel'] = $juubel;
			$maingrupp[$grupi_nimi] = $alamgrupp;
		}
		else if (!array_key_exists('juubel', $alamgrupp)){
			$juubel['isik1'] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp = $maingrupp[$grupi_nimi];
			
			$alamgrupp['juubel'] = $juubel;
		}
		else{
			$alamgrupp = $maingrupp[$grupi_nimi];
			
			$juubel = $alamgrupp['juubel'];
			
			$arv = count($juubel) + 1;
			$juubel['isik' . $arv] = array('nimi' => $nimi, 'email' => $email);
		}
	}
}
/*foreach(array_keys($maingrupp) as $grupi_nimi){
	foreach(array_keys($maingrupp[$grupi_nimi]) as $paev){
		if($paev != 'uldmeil'){
			foreach($maingrupp[$grupi_nimi][$paev] as $isik){
				echo 'Grupp: ' . $grupi_nimi . ', Sünnipäev: ' . $paev . ', Nimi: ' . $isik['nimi'] . ', Email: ' . $isik['email'] . '<br><br>';	
			}
		}
	}
}

echo 'esimeses: ' . count($maingrupp['grupp3']);
echo '<br>teises: ' . count($maingrupp['grupp4']);
echo '<br> kolmandas: ' . count($maingrupp['grupp5']);*/
?>