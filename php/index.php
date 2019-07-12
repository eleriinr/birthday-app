<?php 
//Destination urls 
$people_url = str_replace('sunnipaevaplugin','isikud',$url);
$editgroup_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$addgroup_url = str_replace('sunnipaevaplugin','lisagrupp',$url);

//Acquiring the data from the 'groups' table
global $wpdb;
	
$groups = $wpdb->prefix . 'groups';

$retrieve_data = $wpdb->get_results( "SELECT * FROM $groups" );

include('../wp-content/plugins/birthday-app/php/kontrollskript.php'); 
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/index.js"></script></head>

<h1 class="h1 text-center my-4">Grupid</h1>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col-md-auto">
			<table class="table-striped table-hover border-0 mx-auto my-3 text-center">
				<thead <?php if(sizeof($retrieve_data) == 0) echo ' hidden';?> >
					<tr>
						<th class="p-2">ID</th>
						<th class="p-2">Nimi</th>
						<th class="p-2">Struktuurüksuse ID</th>
						<th class="p-2">Üldmeil</th>
						<th class="p-2">Aktiivne</th>
						<th class="p-2"></th>
					</tr>
				</thead>
				<h3 id="nogroups" class="h3 ml-2 mt-4" <?php if(sizeof($retrieve_data) != 0) echo ' hidden';?> >Gruppe pole</h3>
				<tbody>
					<?php foreach ($retrieve_data as $retrieved_data){
						$gid = $retrieved_data->id;
						$active = $retrieved_data->element_activity;
						$name = $retrieved_data->name;
						$str_id = $retrieved_data->str_id;
						$group_email = $retrieved_data->group_email;
						
						echo '<tr id="' . $gid . '"';
						if($active == 'No') echo ' class="table-danger"';
						echo '>
						
						<td class="p-2">' . $gid . '</td>
						
						<td class="p-2">
							<a href=' . $people_url . '>
								<button class="btn btn-info peoples_table" id="' . $gid . '">' . $name . '</button>
							</a>
						</td>
						
						<td class="p-2">' . $str_id . '</td>
						
						<td class="p-2">' . $group_email . '</td>
						
						<td class="p-2">
							<input type="checkbox" class="active" id="box' . $gid . '" ';
								if($active == "Yes") {echo 'checked';}
							echo '>
						</td>
						
						<td class="p-2">
							<div class="btn-group">
								
								<a href=' . $editgroup_url . '>
									<button class="btn btn-info btn-sm edit" id="' . $gid . '">Muuda</button>
								</a>
								
								<button class="btn btn-danger btn-sm delete">Kustuta</button>
							
							</div>
						</td>
					</tr>';
					}?>
				</tbody>
			</table>
				<a  href=<?php echo $addgroup_url;?>>
					<button class="btn btn-info pull-right">+ Lisa grupp</button>
				</a>
		</div>
		<div class="col"></div>
	</div>
</div>