<?php 
$inimesed_url = str_replace('sunnipaevaplugin','isikud',$url);
$muudagrupp_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$lisagrupp_url = str_replace('sunnipaevaplugin','lisagrupp',$url);

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
				echo '<tr>
						<td class="p-2">' . $retrieved_data->id . '</td>
						<td class="p-2">
							<a href="' . $inimesed_url . '" class="text-info">' . $retrieved_data->nimi . '</a>
						</td>
						<td class="p-2">' . $retrieved_data->struktuuri_id . '</td>
						<td class="p-2">' . $retrieved_data->uldmeil . '</td>
						<td class="p-2">' . $retrieved_data->aktiivne . '</td>
						<td class="p-2">
							<div class="btn-group">
								<form method="post" action=' . $muudagrupp_url . '>
									<input type="number" name="id" value="' . $retrieved_data->id . '" hidden>
									<input value="Muuda" type="submit" class="btn btn-info btn-sm">
								</form>
								<button type="button" class="btn btn-danger btn-sm">Kustuta</button>
							</div>
						</td>
					</tr>';}?>
				</tbody>
			</table>
			<div  class="text-right">
				<a  href=<?php echo $lisagrupp_url;?>>
					<button class="btn btn-info">+ Lisa grupp</button>
				</a>
			</div>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
function getValues(){
	for( var i = 1; i < $("tr").length; i++){
		$("#formgid" + i).val(i);
		$("#formnimi" + i).val($("#nimi" + i).text());
		$("#formid" + i).val($("#id" + i).text());
		$("#formemail" + i).val($("#email" + i).text());
		$("#formakt" + i).val($("#akt" + i).text());
	}
}

$(document).ready(function() {
	getValues();
});</script>