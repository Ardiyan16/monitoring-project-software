<?php 
// include('db_connect.php');
// session_start();
// if(isset($_GET['id'])){
// $user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user as $k) :
?>
<div class="container-fluid">
	<div id="msg"></div>
	<form action="<?php echo base_url('user/edit_user');?>" id="manage-user" method="post">	
		<input type="hidden" name="id" value="<?php echo isset($k['id']) ? $k['id']: '' ?>">
		<div class="form-group">
			<label for="name">Nama Depan</label>
			<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($k['firstname']) ? $k['firstname']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Nama Belakang</label>
			<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($k['lastname']) ? $k['lastname']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($k['email']) ? $k['email']: '' ?>" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<small><i></i></small>
		</div>
		
		<div class="col-lg-12 text-right justify-content-center d-flex">
			<button class="btn btn-primary mr-2">Simpan</button>
			<button class="btn btn-secondary" type="button" onclick="location.href = '<?php echo base_url('user');?>'">Batal</button>
		</div>

	</form>
</div>
<?php endforeach;?>