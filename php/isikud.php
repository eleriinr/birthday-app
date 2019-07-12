<?php
//Destination urls
$addperson_url = str_replace('isikud','lisaisik',$url);
$editperson_url = str_replace('isikud','muudaisik',$url);
$url = str_replace('isikud', 'sunnipaevaplugin',$url);

//Acquiring the necessary data from the 'people' table
global $wpdb;
	
$people = $wpdb->prefix . 'people';
$groups = $wpdb->prefix . 'groups';
	
$current_group = $wpdb->get_results( "SELECT id FROM $groups WHERE current='Yes'" );
$current_group = $current_group[0];
$group_id = $current_group->id;

$retrieve_data = $wpdb->get_results( "SELECT * FROM $people WHERE group_id=$group_id" );
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/isikud.js"></script></head>

<h1 class="h1 text-center my-4">Isikud</h1>
<h1 class="h1 text-center my-4">GRUPI ID: <?php echo $group_id;?>.</h1>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col col-md-auto">
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger">Tagasi</button>
			</a>
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
				<h3 id="nopeople" class="h3 mt-4" <?php if(sizeof($retrieve_data) != 0) echo ' hidden';?> >Isikuid pole</h3>
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
			<a href="<?php echo $addperson_url;?>">
				<button class="btn btn-info pull-right" id="<?php echo $group_id;?>">+ Lisa isik</button>
			</a>
		</div>
		<div class="col"></div>
	</div>
</div>