<!DOCTYPE html>
<html lang="en">
<?php 
if ($this->session->userdata('status') == null) {
    redirect('login');
}
?>
<?= @$head; ?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

	<!-- Page Wrapper -->
	<div class="wrapper">
		<!-- Sidebar -->
        <?= @$sidebar;  ?>
        <!-- End of Side bar -->
                
        <!-- Topbar -->
		<?= @$topbar; ?>
		<!-- End of Topbar -->
                
		<!-- Content Wraper -->
		<div class="content-wrapper">
			<!-- Main Content -->
			<div class="content">
				
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?php echo $page ?></h1>
                        </div><!-- /.col -->

                        </div><!-- /.row -->
                            <hr class="border-primary">
                    </div>
                    <!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- content -->
                    <?= @$content; ?>
                    <!-- End of content -->

			</div>
			<!-- End of Main Content -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            </div>
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Wrapper -->
	<!-- footer -->
	<?= @$footer; ?>
	<!-- End of Footer -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Keluar Jika Anda Ingin Keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?php echo base_url("index.php/login/logout")?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

</body>
</html>