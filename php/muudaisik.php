<?php 
//Destination url
$url = str_replace('muudaisik', 'isikud',$url);

//Acquiring the necessary data from the 'isikud' table
global $wpdb;
	
$people = $wpdb->prefix . 'isikud';
	
//ID of the person
$id = $_POST['id'];
	
$retrieve_data = $wpdb->get_results("SELECT * FROM $people WHERE id=$id");
$retrieved_data = $retrieve_data[0];
	
//Data
$first_name = $retrieved_data->eesnimi;
$last_name = $retrieved_data->perenimi;
$birthday = $retrieved_data->kuupaev;
$email = $retrieved_data->email;
$recipients_email = $retrieved_data->saaja_email;
$comment = $retrieved_data->kommentaar;
$group_id = $retrieved_data->grupi_id;
$id = $retrieved_data->id;
?>
<head><script src="../wp-content/plugins/birthday-app/scripts/muudaisik.js"></script></head>

<h1 class="h1 text-center my-4" >Muuda isik</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<form method="post" action=<?php echo $url;?>>
					<input type="number" name="id" value="<?php echo $group_id; ?>" hidden>
					<input value="Tagasi" type="submit" class="btn btn-danger my-3">
			</form>
			
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
				<div class="form-group">
					<label for="email">Meili saaja: </label>
					<input class="form-control" id="recipients_email" type="email" value="<?php echo $recipients_email; ?>">
				</div>
				<div class="form-group">
					<label for="comment">Kommentaar: </label>
					<input class="form-control" id="comment" type="text" value="<?php echo $comment; ?>">
				</div>
				<div class="form-group">
					<label for="group_id">Grupi ID: </label>
					<input class="form-control" id="group_id" type="number" value="<?php echo $group_id; ?>" required>
				</div>
				<input type="number" name="id" value="<?php echo $group_id; ?>" hidden>
				<input value="Muuda" id="edit" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>