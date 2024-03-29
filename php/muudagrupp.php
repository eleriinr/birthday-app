<?php
//Destination url
$url = str_replace('sunnipaevaplugin-muudagrupp', 'sunnipaevaplugin',$url);

//Acquiring the necessary data from the 'grupid' table
global $wpdb;

$groups = $wpdb->prefix . 'groups';
	
$current_group = $wpdb->get_results( "SELECT id FROM $groups WHERE current='Yes'" );
$current_group = $current_group[0];
$group_id = $current_group->id;

$retrieve_data = $wpdb->get_results("SELECT * FROM $groups WHERE id=$group_id");
$retrieved_data = $retrieve_data[0];

//Data
$name = $retrieved_data->name;
$str_id = $retrieved_data->str_id;
$group_email = $retrieved_data->group_email;
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/muudagrupp.js"></script></head>

<h1 class="h1 text-center my-4" >Muuda gruppi</h1>
<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
				<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="group_id">Grupi ID: </label>
					<?php echo '<input class="form-control" id="group_id" type="number" value="' . $group_id . '" readonly>';?>
				</div>
				<div class="form-group">
					<label for="name">Nimi: </label>
					<input class="form-control" id="name" type="text" placeholder="Nimi" value="<?php echo $name; ?>" required>
				</div>
				<div class="form-group">
					<label for="str_id">Struktuuri ID: </label>
					<input class="form-control" id="str_id" type="text" placeholder="ID" value="<?php echo $str_id; ?>" required>
				</div>
				<div class="form-group">
					<label for="group_email">Üldmeil: </label>
					<input class="form-control" id="group_email" type="email" placeholder="Email" value="<?php echo $group_email; ?>" required>
				</div>
				<h6 id="invalid" class="h6" hidden>Email on vigane!</h6>
				<input value="Muuda" type="submit" id="edit" class="btn btn-info pull-right d-block"> 
			</form>
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>
		</div>
		<div class="col"></div>
	</div>
</div>