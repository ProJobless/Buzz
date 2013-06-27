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
				<div class="box">
					<div class="box-header">
						<div class="title">Tweets Refreshed</div>
					</div>

					<div class="box-content padded">
						<div class="row-fluid">
							<div class="span12">
								 <div class="tweets_refreshed" style="height: 300px" id="tweets_refreshed"></div>
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
				 				      "className": ".tweets",
				 				      "data": [
									  <?php foreach($tweets_refreshed as $t)
									  {
										  echo "{";
									  
									  	 echo '"x":"'.date("Y-m-d", $t->timestamp).'",';
									  	 echo '"y":'.$t->tweets_fetched;

										 echo "},";
									  }
									  echo "]";
									  ?>
				 				      
				 				    }
				 				  ]
				 				};
				 				var opts = {
				 				  "dataFormatX": function (x) { return d3.time.format('%Y-%m-%d').parse(x); },
				 				  "tickFormatX": function (x) { return d3.time.format('%Y-%m-%d')(x); },
				 				  "mouseover": function (d, i) {
				 				    var pos = $(this).offset();
				 				    $(tt).text(d3.time.format('%Y-%m-%d')(d.x) + ' : ' + d.y)
				 				      .css({top: topOffset + pos.top, left: pos.left + leftOffset})
				 				      .show();
				 				  },
				 				  "mouseout": function (x) {
				 				    $(tt).hide();
				 				  }
				 				};
				 				var myChart = new xChart('line-dotted', data, '#tweets_refreshed', opts);
				 				</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>