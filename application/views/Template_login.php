<!DOCTYPE html>
<html lang="en">
<?php 
if ($this->session->userdata('status') == 'login') {
    redirect(base_url('user'));
}
?>
<?= @$head; ?>
<body id="page-top">

		<!-- Content Wraper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">

				<!-- content -->
				<?= @$content; ?>
				<!-- End of content -->

			</div>
			<!-- End of Main Content -->
			
			<!-- footer -->
			<?= @$footer; ?>
			<!-- End of Footer -->
			
        </div>
		<!-- End of Content Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/assets/js/sb-admin-2.min.js"></script>

</body>
</html>

</body>
</html>