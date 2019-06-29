
google.charts.load('current', {
	'packages' : [ 'corechart' ]
});
google.charts.setOnLoadCallback(drawPieChart);
google.charts.setOnLoadCallback(drawBarChart);

/**
 * 걸음걸이에 대한 분석 결과를 piechart로 뿌려주는 기능
 */
function drawPieChart() {
	var data = google.visualization.arrayToDataTable([
			[ '결과', 'percent' ], [ '정상', 11 ], [ '팔자걸음', 4 ],
			[ '안짱걸음', 2 ], [ '구부정한 자세', 2 ] ]);

	var chart = new google.visualization.PieChart(document
			.getElementById('piechart'));

	chart.draw(data);
}

/**
 * 분석 결과로 판단되는 증상을 barchart로 뿌려주는 기능
 */
function drawBarChart() {
  var data = google.visualization.arrayToDataTable([
    ["증상", "%", { role: "style" } ],
    ["치매", 60, "red"],
    ["파킨슨병", 30, "yellow"],
    ["알츠하이머", 10, "green"]
  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var chart = new google.visualization.BarChart(document.getElementById("barchart"));
  chart.draw(view);
}
