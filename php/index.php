<?php 
//Destination urls 
$isikud_url = str_replace('sunnipaevaplugin','isikud',$url);
$muudagrupp_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$lisagrupp_url = str_replace('sunnipaevaplugin','lisagrupp',$url);

//Acquiring the data from the 'grupid' table
global $wpdb;
	
	$table_name = $wpdb->prefix . 'grupid';
	
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );
?>

<h1 class="h1 text-center my-4">Grupid</h1>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col-md-auto">
			<table class="table-striped table-hover border-0 mx-auto my-3 text-center">
				<thead>
					<tr>
						<th class="p-2">ID</th>
						<th class="p-2">Nimi</th>
						<th class="p-2">Struktuurüksuse ID</th>
						<th class="p-2">Üldmeil</th>
						<th class="p-2">Aktiivne</th>
						<th class="p-2"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($retrieve_data as $retrieved_data){
						$gid = $retrieved_data->id;
						$aktiivne = $retrieved_data->aktiivne;
						$nimi = $retrieved_data->nimi;
						$struktuuri_id = $retrieved_data->struktuuri_id;
						$uldmeil = $retrieved_data->uldmeil;
						
						echo '<tr id="' . $gid . '"';
						if($aktiivne == 'Ei') echo ' class="table-danger"';
						echo '>
						
						<td class="p-2">' . $gid . '</td>
						
						<td class="p-2">
							<form method="post" action=' . $isikud_url . '>
								<input type="number" value="' . $gid . '" name="id" hidden>
								<input value="' . $nimi . '" type="submit" class="btn btn-info btn-sm">
							</form>
						</td>
						
						<td class="p-2">' . $struktuuri_id . '</td>
						
						<td class="p-2">' . $uldmeil . '</td>
						
						<td class="p-2">
							<input type="checkbox" class="aktiivne" id="kast' . $gid . '" ';
								if($aktiivne == "Jah") {echo 'checked';}
							echo '>
						</td>
						
						<td class="p-2">
							<div class="btn-group">
								
								<form method="post" action=' . $muudagrupp_url . '>
									<input type="number" value="' . $gid . '" name="id" hidden>
									<input value="Muuda" type="submit" class="btn btn-info btn-sm">
								</form>
								
								<button class="btn btn-danger btn-sm delete">Kustuta</button>
							
							</div>
						</td>
					</tr>';
					}?>
				</tbody>
			</table>
				<a  href=<?php echo $lisagrupp_url;?>>
					<button class="btn btn-info pull-right">+ Lisa grupp</button>
				</a>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
			var id = this.parentElement.parentElement.parentElement.id;
			$("tr#" + id).remove();
		
			var andmed = { action: "grupp_kustuta", id: id};
			
			$.ajax(ajaxurl, {
				"data": andmed,
				"type": "POST"
			})
			.done(function () {
				console.log("done");
			})
			.fail(function () {
				console.log("fail");
			});
	});
	
	jQuery(".aktiivne").click(function() {
			var rida = this.parentElement.parentElement;
			var id = rida.id;
			var kast = $("#kast" + id);
			var aktiivne = "Ei";
	
			if ( kast.is(':checked')) { 
				aktiivne = "Jah";
				rida.classList.remove("table-danger");
			}
			else{
				rida.classList.add("table-danger");
			}
			
			var andmed = { 
							action: "grupp_muuda_aktiivsust",
							id: id,
							aktiivne: aktiivne
			};
			
			$.ajax(ajaxurl, {
				"data": andmed,
				"type": "POST"
			})
			.done(function () {
				console.log("done");
			})
			.fail(function () {
				console.log("fail");
			})
	});
})
</script>