<?php
//Destination url
$url = str_replace('muudagrupp', 'sunnipaevaplugin',$url);

//Acquiring the necessary data from the 'grupid' table
global $wpdb;

$groups = $wpdb->prefix . 'grupid';

//ID of the group
$id = $_POST['id'];

$retrieve_data = $wpdb->get_results("SELECT * FROM $groups WHERE id=$id");
$retrieved_data = $retrieve_data[0];

//Data
$name = $retrieved_data->nimi;
$str_id = $retrieved_data->struktuuri_id;
$group_email = $retrieved_data->uldmeil;
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/muudagrupp.js"></script></head>

<h1 class="h1 text-center my-4" >Muuda gruppi</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>

			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="group_id">Grupi ID: </label>
					<?php echo '<input class="form-control" id="group_id" type="number" value="' . $id . '" readonly>';?>
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
				<input value="Muuda" type="submit" id="edit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>