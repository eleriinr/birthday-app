<?php 
//Destination url
$url = str_replace('muudaisik', 'isikud',$url);

//Acquiring the necessary data from the 'people' table
global $wpdb;
	
$people = $wpdb->prefix . 'people';
$groups = $wpdb->prefix . 'groups';

$all_ids = $wpdb->get_results( "SELECT * FROM $groups" );

$current_person = $wpdb->get_results( "SELECT id FROM $people WHERE current='Yes'" );
$current_person = $current_person[0];
$id = $current_person->id;

$retrieve_data = $wpdb->get_results("SELECT * FROM $people WHERE id=$id");
$retrieved_data = $retrieve_data[0];
	
//Data
$first_name = $retrieved_data->first_name;
$last_name = $retrieved_data->last_name;
$birthday = $retrieved_data->birthday;
$email = $retrieved_data->email;
$recipients_email = $retrieved_data->recipients_email;
$comment = $retrieved_data->comment;
$group_id = $retrieved_data->group_id;
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/muudaisik.js"></script></head>

<h1 class="h1 text-center my-4" >Muuda isik</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">			
			<?php echo '<form action=' . $url . ' method="post">';?>
					<input class="form-control" id="id" type="number" value="<?php echo $id; ?>" hidden>
				<div class="form-group">
					<label for="first_name">Eesnimi: </label>
					<input class="form-control" id="first_name" type="text" value="<?php echo $first_name; ?>" required>
				</div>
				<div class="form-group">
					<label for="last_name">Perenimi: </label>
					<input class="form-control" id="last_name" type="text" value="<?php echo $last_name; ?>" required>
				</div>
				<div class="form-group">
					<label for="birthday">Kuupäev: </label>
					<input class="form-control" id="birthday" type="date" value="<?php echo $birthday; ?>" required>
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" value="<?php echo $email; ?>" required>
				</div>
				<h6 id="invalid" class="h6" hidden>Email on vigane!</h6>
				<div class="form-group">
					<label for="email">Meili saaja: </label>
					<input class="form-control" id="recipients_email" type="text" value="<?php echo $recipients_email; ?>">
				</div>
				<h6 id="invalidrecipient" class="h6" hidden>Email on vigane!</h6>
				<div class="form-group">
					<label for="comment">Kommentaar: </label>
					<input class="form-control" id="comment" type="text" value="<?php echo $comment; ?>">
				</div>
				<div class="form-group">
					<label for="group_id">Grupp:</label>
					<select class="form-control" id="group_id">
						<?php foreach($all_ids as $option){
							echo '<option '; 
							if ($option->id == $group_id){
								echo 'selected ';
							}
							echo 'value="' . $option->id . '">' . $option->name . '</option>';
						} ?>
					</select>
				</div>
				<input type="number" name="id" value="<?php echo $group_id; ?>" hidden>
				<input value="Muuda" id="edit" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
			<form method="post" action=<?php echo $url;?>>
					<input type="number" name="id" value="<?php echo $group_id; ?>" hidden>
					<input value="Tagasi" type="submit" class="btn btn-danger">
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>