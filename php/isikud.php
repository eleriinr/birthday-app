<?php
//Destination urls
$addperson_url = str_replace('isikud','lisaisik',$url);
$editperson_url = str_replace('isikud','muudaisik',$url);
$url = str_replace('sunnipaevaplugin-isikud', 'sunnipaevaplugin',$url);

//Acquiring the necessary data from the 'people' table
global $wpdb;
	
$people = $wpdb->prefix . 'people';
$groups = $wpdb->prefix . 'groups';
	
$current_group = $wpdb->get_results( "SELECT * FROM $groups WHERE current='Yes'" );
$current_group = $current_group[0];
$group_id = $current_group->id;

$retrieve_data = $wpdb->get_results( "SELECT * FROM $people WHERE group_id=$group_id" );
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/isikud.js"></script></head>

<h1 class="h1 text-center my-4">Isikud</h1>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col col-md-auto">
			<div class="container">
				<div class="row justify-content-md-center">
				<div class="col">
					<a id="addpersonbutton" href=<?php echo $addperson_url; if(sizeof($retrieve_data) == 0) echo ' hidden';?>>
						<button class="add btn btn-info pull-left" id="<?php echo $group_id;?>">+ Lisa isik</button>
					</a>
				</div>
					<div class="col col-md-auto">
						<a id="addpersonbuttoncenter" class="text-center m-auto" href=<?php echo $addperson_url; if(sizeof($retrieve_data) != 0) echo ' hidden';?>>
							<button class="add btn btn-info" id="<?php echo $group_id;?>">+ Lisa isik</button>
						</a>
					</div>
					<div class="col"></div>
				</div>					
			</div>
			<table class="table-striped table-hover border-0 mx-auto text-center my-3">
				<thead <?php if(sizeof($retrieve_data) == 0) echo ' hidden';?> >
					<tr>
						<th class="p-2">Eesnimi</th>
						<th class="p-2">Perenimi</th>
						<th class="p-2">Kuupäev</th>
						<th class="p-2">Email</th>
						<th class="p-2">Emaili saaja</th>
						<th class="p-2">Aktiivne</th>
					</tr>
				</thead>
				<h3 id="nopeople" class="h3 mt-3 ml-3" <?php if(sizeof($retrieve_data) != 0) echo ' hidden';?> >Isikuid pole</h3>
				<tbody>
				<?php foreach($retrieve_data as $retrieved_data){
					$first_name = $retrieved_data->first_name;
					$last_name = $retrieved_data->last_name;
					$birthday = date('d.m.Y', strtotime($retrieved_data->birthday));
					$email = $retrieved_data->email;
					$recipients_email = $retrieved_data->recipients_email;
					$id = $retrieved_data->id;
					$active = $retrieved_data->element_activity;
					
					echo '<tr id="' . $id . '"';
					if($active == 'No') echo ' class="table-danger"';
					echo '>
					
						<td class="p-2">' . $first_name . '</td>
						
						<td class="p-2">' . $last_name . '</td>
						
						<td class="p-2">' . $birthday . '</td>
						
						<td class="p-2"><nobr>' . $email . '<nobr></td>
						
						<td class="p-2">' . $recipients_email . '</td>
						
						<td class="p-2">
							<input type="checkbox" class="active" id="box' . $id . '" ';
							if($active == "Yes") {echo 'checked';}
							echo '>
						</td>
						
						<td class="p-2">
							<div class="btn-group">
							
								<a href=' . $editperson_url . '>
									<button class="btn btn-info btn-sm edit" id="' . $id . '">Muuda</button>
								</a>
							
								<button type="button" class="btn btn-danger btn-sm delete">Kustuta</button>
							</div>
						</td>
					</tr>';
				}?>
				</tbody>
			</table>
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col">
						<a id="backbutton" href=<<?php echo $url; if(sizeof($retrieve_data) == 0) echo ' hidden';?>>
							<button class="back btn btn-danger pull-left">Tagasi</button>
						</a>
					</div>
					<div class="col col-md-auto">
						<a id="backbuttoncenter" class="text-center m-auto" href=<?php echo $url; if(sizeof($retrieve_data) != 0) echo ' hidden';?>>
							<button class="back btn btn-danger">Tagasi</button>
						</a>
					</div>
					<div class="col"></div>
				</div>					
			</div>
		</div>
		<div class="col"></div>
	</div>
</div>