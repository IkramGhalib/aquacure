<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src=" https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="bower_components/fastclick/lib/fastclick.js"></script>

		<!-- These below are different than the previous files of AdminLTE2 -->
		<script src="plugins1/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="plugins1/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="plugins1/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="plugins1/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="plugins1/jszip/jszip.min.js"></script>
		<script src="plugins1/pdfmake/pdfmake.min.js"></script>
		<script src="plugins1/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="plugins1/datatables-buttons/js/buttons.colVis.min.js"></script>
		<script src="dist1/js/adminlte.min.js"></script>

<script>
			$(function () {
				$("#example1").DataTable({
					"order":[[19,"desc"]],
					"lenthMenu":[[10,25,50,-1],[10,25,50,"All"]]
					
					"responsive": true, "lengthChange": true, "autoWidth": true,
					"buttons": ["copy", "csv", "excel", "colvis"]
				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false,
					"responsive": true,
				});
			});
		</script>
