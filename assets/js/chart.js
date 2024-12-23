// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var xValues = ["Hadir", "Tidak hadir"];
var yValues = [75, 25];
var barColors = ["#b91d47", "#00aba9"];

var ctx_riwayat = document.getElementById("grafik_riwayat");
var ctx = document.getElementById("grafik_perhari");
var ctx_perbulan = document.getElementById("grafik_perbulan");

var grafik_perhari = new Chart(ctx, {
	type: "pie",
	data: {
		labels: xValues,
		datasets: [
			{
				data: [20, 45],
				backgroundColor: ["#4e73df", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		title: {
			display: false,
			// text: "World Wide Wine Production 2018",
		},
	},
});

var grafik_riwayat = new Chart(ctx_riwayat, {
	type: "pie",
	data: {
		labels: xValues,
		datasets: [
			{
				data: [20, 45],
				backgroundColor: ["#4e73df", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		title: {
			display: false,
			// text: "World Wide Wine Production 2018",
		},
	},
});



var grafik_perbulan = new Chart(ctx_perbulan, {
	type: "pie",
	data: {
		labels: xValues,
		datasets: [
			{
				data: [55, 45],
				backgroundColor: ["#4e73df", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		title: {
			display: false,
			// text: "World Wide Wine Production 2018",
		},
	},
});