// Call the dataTables jQuery plugin
// Call the dataTables jQuery plugin
$(document).ready(function () {

  var SubMenu = $("#SubMenu").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
  });

  var SubMenu = $("#AbsensiManualKonfirmasi").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
  });

  var SubMenu = $("#AbsensiManualInput").DataTable({
	rowReorder: {
		selector: "td:nth-child(2)",
	},
	responsive: true,
});
  
  var tableAccess = $("#tableAccess").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});
  var tableTime = $("#tableTime").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});
  var tableRole = $("#tableRole").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});
  var tableUser = $("#tableUser").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});
  var tableTanggal = $("#tableTanggal").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});
  var tableBulan = $("#tableBulan").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
  });
	
  var tableSubMenu = $("#tableSubMenu").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
  });
	
  var tableSubMenu = $("#tableRiwayat").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});

	var tableSubMenu = $("#attendanceRank").DataTable({
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		responsive: true,
	});

  $("#bulan").on("change", function () {
    tableBulan.columns(0).search(this.value).draw();
  });

  $('#tanggal').on("change", function () {
    tableTanggal.columns(1).search(this.value).draw();
  })

  // $("#dropdown2").on("change", function () {
  //   table.columns(2).search(this.value).draw();
  // });

  
  
});
  