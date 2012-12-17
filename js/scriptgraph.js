$(document).ready(function(){
	var line1 = [
				 ['January', graph_months[0]], 
				 ['February', graph_months[1]], 
				 ['March', graph_months[2]],
				 ['April', graph_months[3]], 
				 ['May', graph_months[4]],
				 ['June', graph_months[5]], 
				 ['July', graph_months[6]],
				 ['August', graph_months[7]],
				 ['September', graph_months[8]],
				 ['October', graph_months[9]],
				 ['November', graph_months[10]],
				 ['December', graph_months[11]]
				];
	var plot1b = $.jqplot('chartdiv', [line1], {
	title: 'Boarders Activity Graph',
	series:[{renderer:$.jqplot.BarRenderer}],
	axesDefaults: {
		tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
		tickOptions: {
		  fontFamily: 'Georgia',
		  fontSize: '10pt',
		  angle: -45
		}
	},
	axes: {
	  xaxis: {
		renderer: $.jqplot.CategoryAxisRenderer
	  }
	}
	});
});