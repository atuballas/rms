$(document).ready(function(){
	
	var line1 = [
				 ['January', 7], 
				 ['February', 9], 
				 ['March', 15],
				 ['April', 12], 
				 ['May', 3],
				 ['June', 6], 
				 ['July', 18],
				 ['August', 18],
				 ['September', 18],
				 ['October', 18],
				 ['November', 18],
				 ['December', 18]
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