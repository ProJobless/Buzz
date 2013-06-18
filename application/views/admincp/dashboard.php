<div class="main-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="area-top clearfix">
				<div class="pull-left header">
					<h3 class="title"><?php echo $heading; ?></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid padded">
		<div class="row-fluid">
			<div class="span9">
				<!-- find me in partials/big_chart -->

				<div class="box">
					<div class="box-header">
						<div class="title">Trends</div>
					</div>

					<div class="box-content padded">
						<div class="row-fluid">
							<div class="span4">
								
							</div>
						</div>
					</div>
				</div>
				<script>
				var tt = document.createElement('div'),
				  leftOffset = -(~~$('html').css('padding-left').replace('px', '') + ~~$('body').css('margin-left').replace('px', '')),
				  topOffset = -32;
				tt.className = 'ex-tooltip';
				document.body.appendChild(tt);

				var data = {
				  "xScale": "time",
				  "yScale": "linear",
				  "main": [
				    {
				      "className": ".pizza",
				      "data": [
				        {
				          "x": "2012-11-05",
				          "y": 6
				        },
				        {
				          "x": "2012-11-06",
				          "y": 6
				        },
				        {
				          "x": "2012-11-07",
				          "y": 8
				        },
				        {
				          "x": "2012-11-08",
				          "y": 3
				        },
				        {
				          "x": "2012-11-09",
				          "y": 4
				        },
				        {
				          "x": "2012-11-10",
				          "y": 9
				        },
				        {
				          "x": "2012-11-11",
				          "y": 6
				        }
				      ]
				    }
				  ]
				};
				var opts = {
				  "dataFormatX": function (x) { return d3.time.format('%Y-%m-%d').parse(x); },
				  "tickFormatX": function (x) { return d3.time.format('%A')(x); },
				  "mouseover": function (d, i) {
				    var pos = $(this).offset();
				    $(tt).text(d3.time.format('%A')(d.x) + ': ' + d.y)
				      .css({top: topOffset + pos.top, left: pos.left + leftOffset})
				      .show();
				  },
				  "mouseout": function (x) {
				    $(tt).hide();
				  }
				};
				var myChart = new xChart('line-dotted', data, '#example4', opts);
				</script>
			</div>
		</div>
	</div>
</div>

