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
			$alamgrupp1['uldmeil'] = $saajameil;
			
			$tana['isik1'] = array('nimi' => $nimi, 'email' => $email);
		
			$alamgrupp1['tana'] = $tana;
				
			$maingrupp[$grupi_nimi] = $alamgrupp1;
		}
		else if (!array_key_exists('tana', $alamgrupp1)){
			$tana['isik1'] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp1 = $maingrupp[$grupi_nimi];
			
			$alamgrupp1['tana'] = $tana;
		}
		else{
			$alamgrupp1 = $maingrupp[$grupi_nimi];
			
			$tana = $alamgrupp1['tana'];
			
			$arv = count($tana) + 1;
			$tana['isik' . $arv] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp1['tana'] = $tana;
			$maingrupp[$grupi_nimi] = $alamgrupp1;
		}
	}
	else if($homme_kuupaev == $sunni_kuupaev && $aktiivne == 'Jah'){
		if (!array_key_exists($grupi_nimi, $maingrupp)){
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saajagrupp = $saajad[0];
			$saajameil = $saajagrupp->uldmeil;
			$alamgrupp2['uldmeil'] = $saajameil;
			
			$homme['isik1'] = array('nimi' => $nimi, 'email' => $email);
		
			$alamgrupp2['homme'] = $homme;
				
			$maingrupp[$grupi_nimi] = $alamgrupp2;
		}
		else if (!array_key_exists('homme', $alamgrupp2)){
			$homme['isik1'] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp2 = $maingrupp[$grupi_nimi];
			
			$alamgrupp2['homme'] = $homme;
		}
		else{
			$alamgrupp2 = $maingrupp[$grupi_nimi];
			
			$homme = $alamgrupp2['homme'];
			
			$arv = count($homme) + 1;
			$homme['isik' . $arv] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp2['homme'] = $tana;
			$maingrupp[$grupi_nimi] = $alamgrupp2;
		}
	}
	else if($juubel_kuupaev == $sunni_kuupaev && (intval($aasta) - intval($sunni_aasta))%5 == 0 && $aktiivne == 'Jah'){		
		if (!array_key_exists($grupi_nimi, $maingrupp)){
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saajagrupp = $saajad[0];
			$saajameil = $saajagrupp->uldmeil;
			$alamgrupp3['uldmeil'] = $saajameil;
			
			$juubel['isik1'] = array('nimi' => $nimi, 'email' => $email);
		
			$alamgrupp3['juubel'] = $juubel;
			$maingrupp[$grupi_nimi] = $alamgrupp3;
		}
		else if (!array_key_exists('juubel', $alamgrupp3)){
			$juubel['isik1'] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp3 = $maingrupp[$grupi_nimi];
			
			$alamgrupp3['juubel'] = $juubel;
		}
		else{
			$alamgrupp3 = $maingrupp[$grupi_nimi];
			
			$juubel = $alamgrupp3['juubel'];
			
			$arv = count($juubel) + 1;
			$juubel['isik' . $arv] = array('nimi' => $nimi, 'email' => $email);
			
			$alamgrupp3['juubel'] = $tana;
			$maingrupp[$grupi_nimi] = $alamgrupp3;
		}
	}
}

/*foreach(array_keys($maingrupp) as $grupi_nimi){
	echo 'GRUPP: ' . $grupi_nimi . '<br>';
	foreach(array_keys($maingrupp[$grupi_nimi]) as $paev){
		if($paev != 'uldmeil'){
			echo 'PAEV: ' . $paev . '<br>';
			foreach($maingrupp[$grupi_nimi][$paev] as $isik){
				echo 'Nimi: ' . $isik['nimi'] . ', Email: ' . $isik['email'] . '<br><br>';	
			}
		}
	}
}*/
?>