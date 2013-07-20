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
			<div class="span12">
				<div class="box">
					<div class="box-header">
						<div class="title">Analytics</div>
						<ul class="nav nav-tabs nav-tabs-right">
							<li class="active"><a data-toggle="tab" href="#general">General</a></li>
							<li><a data-toggle="tab" href="#twitter">Twitter</a></li>
							<li><a data-toggle="tab" href="#facebook">Facebook</a></li>
							<li><a data-toggle="tab" href="#blog">Blog</a></li>
						</ul>
					</div>

					<div class="box-content padded">
						<div class="tab-content">
							<div id="general" class="tab-pane active">
								<div class="row-fluid">
									<div class="span12">
										<div class="box">
											<div class="box-header">
												<div class="title">User Login</div>
											</div>

											<div class="box-content padded">
												<div class="row-fluid">
													<div class="span10">
														<div class="" style="height: 350px" id="user_login"></div>
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
																<?php foreach($stats as $t)
																{
																	echo "{";
									  
																		echo '"x":"'.date("Y-m-d", $t->timestamp).'",';
																		echo '"y":'.$t->user_logins;

																		echo "},";
																	}
																	echo "] }";
																	?>
				 				      
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
																var myChart = new xChart('line-dotted', data, '#user_login', opts);
														</script>
													</div>
								
													<div class="span2">
														<?php $i = 1; foreach($stats as $t)
														{
														?>
														<div class="dashboard-stats">
															<div class="stats-label"><?php echo date("l", $t->timestamp); ?></div>
															<ul class="inline">
																<li class="glyph"><i class="icon-twitter icon-2x"></i></li>
																<li class="count"> <?php echo $t->user_logins;
																	if($i <= 5){if($t->user_logins >= $stats[$i]->user_logins)
																		{
																			echo '<i class="icon-arrow-up icon-large" style="color:green;">'.number_format ((($t->user_logins - $stats[$i]->user_logins) / $stats[$i]->user_logins * 100), 2 ).'</i>';
																		}
																		else
																		{
																			echo '<i class="icon-arrow-down icon-large" style="color:red;">'.number_format ((($stats[$i]->user_logins - $t->user_logins) / $t->user_logins * 100), 2 ).'</i>';
																		} }?></li>
															</ul>
														</div>
														<?php
															$i++; }
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12">
										<div class="box">
											<div class="box-header">
												<div class="title">User Registration</div>
											</div>

											<div class="box-content padded">
												<div class="row-fluid">
													<div class="span10">
														<div class="tweets_refreshed" style="height: 350px" id="user_registration"></div>
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
																<?php foreach($stats as $t)
																{
																	echo "{";
									  
																		echo '"x":"'.date("Y-m-d", $t->timestamp).'",';
																		echo '"y":'.$t->registrations;

																		echo "},";
																	}
																	echo "] }";
																	?>
				 				      
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
																var myChart = new xChart('line-dotted', data, '#user_registration', opts);
														</script>
													</div>
								
													<div class="span2">
														<?php $i = 1; foreach($stats as $t)
														{
														?>
														<div class="dashboard-stats">
															<div class="stats-label"><?php echo date("l", $t->timestamp); ?></div>
															<ul class="inline">
																<li class="glyph"><i class="icon-twitter icon-2x"></i></li>
																<li class="count"> <?php echo $t->registrations;
																	if($i <= 5){if($t->registrations >= $stats[$i]->registrations)
																		{
																			echo '<i class="icon-arrow-up icon-large" style="color:green;">'.number_format ((($t->registrations - $stats[$i]->registrations) / $stats[$i]->registrations * 100), 2 ).'</i>';
																		}
																		else
																		{
																			echo '<i class="icon-arrow-down icon-large" style="color:red;">'.number_format ((($stats[$i]->registrations - $t->registrations) / $t->registrations * 100), 2 ).'</i>';
																		} }?></li>
															</ul>
														</div>
														<?php
															$i++; }
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div id="twitter" class="tab-pane active">
								<div class="row-fluid">
									<div class="span12">
										<div class="box">
											<div class="box-header">
												<div class="title">Tweets Posted</div>
											</div>

											<div class="box-content padded">
												<div class="row-fluid">
													<div class="span10">
														<div class="tweets_refreshed" style="height: 350px" id="tweets_refreshed"></div>
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
																<?php foreach($stats as $t)
																{
																	echo "{";
									  
																		echo '"x":"'.date("Y-m-d", $t->timestamp).'",';
																		echo '"y":'.$t->tweets_fetched;

																		echo "},";
																	}
																	echo "] }";
																	?>
				 				      
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
								
													<div class="span2">
														<?php $i = 1; foreach($stats as $t)
														{
														?>
														<div class="dashboard-stats">
															<div class="stats-label"><?php echo date("l", $t->timestamp); ?></div>
															<ul class="inline">
																<li class="glyph"><i class="icon-twitter icon-2x"></i></li>
																<li class="count"> <?php echo $t->tweets_fetched;
																	if($i <= 5){if($t->tweets_fetched >= $stats[$i]->tweets_fetched)
																		{
																			echo '<i class="icon-arrow-up icon-large" style="color:green;">'.number_format ((($t->tweets_fetched - $stats[$i]->tweets_fetched) / $stats[$i]->tweets_fetched * 100), 2 ).'</i>';
																		}
																		else
																		{
																			echo '<i class="icon-arrow-down icon-large" style="color:red;">'.number_format ((($stats[$i]->tweets_fetched - $t->tweets_fetched) / $t->tweets_fetched * 100), 2 ).'</i>';
																		} }?></li>
															</ul>
														</div>
														<?php
															$i++; }
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12">
										<div class="box">
											<div class="box-header">
												<div class="title">Tweets Posted</div>
											</div>

											<div class="box-content padded">
												<div class="row-fluid">
													<div class="span10">
														<div class="tweets_posted" style="height: 350px" id="tweets_posted"></div>
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
																<?php foreach($stats as $t)
																{
																	echo "{";
								  
																		echo '"x":"'.date("Y-m-d", $t->timestamp).'",';
																		echo '"y":'.$t->tweets_count;

																		echo "},";
																	}
																	echo "] }";
																	?>
			 				      
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
																var myChart = new xChart('line-dotted', data, '#tweets_posted', opts);
														</script>
													</div>
							
													<div class="span2">
														<?php $i = 1; foreach($stats as $t)
														{
														?>
														<div class="dashboard-stats">
															<div class="stats-label"><?php echo date("l", $t->timestamp); ?></div>
															<ul class="inline">
																<li class="glyph"><i class="icon-twitter icon-2x"></i></li>
																<li class="count"> <?php echo $t->tweets_count;
																	if($i <= 5){if($t->tweets_count >= $stats[$i]->tweets_count)
																		{
																			echo '<i class="icon-arrow-up icon-large" style="color:green;">'.number_format ((($t->tweets_count - $stats[$i]->tweets_count) / $stats[$i]->tweets_count * 100), 2 ).'</i>';
																		}
																		else
																		{
																			echo '<i class="icon-arrow-down icon-large" style="color:red;">'.number_format ((($stats[$i]->tweets_count - $t->tweets_count) / $t->tweets_fetched * 100), 2 ).'</i>';
																		} }?></li>
															</ul>
														</div>
															<?php
																$i++; }
															?>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							
							</div>

							<div id="facebook" class="tab-pane active">
								Coming soon!
							</div>
							
							<div id="blog" class="tab-pane active">
								<div class="row-fluid">
									<div class="span12">
										<div class="box">
											<div class="box-header">
												<div class="title">Blogs Fetched</div>
											</div>

											<div class="box-content padded">
												<div class="row-fluid">
													<div class="span10">
														<div class="" style="height: 350px" id="blogs_fetched"></div>
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
																<?php foreach($stats as $t)
																{
																	echo "{";
									  
																		echo '"x":"'.date("Y-m-d", $t->timestamp).'",';
																		echo '"y":'.$t->blogs_fetched;

																		echo "},";
																	}
																	echo "] }";
																	?>
				 				      
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
																var myChart = new xChart('line-dotted', data, '#blogs_fetched', opts);
														</script>
													</div>
								
													<div class="span2">
														<?php $i = 1; foreach($stats as $t)
														{
														?>
														<div class="dashboard-stats">
															<div class="stats-label"><?php echo date("l", $t->timestamp); ?></div>
															<ul class="inline">
																<li class="glyph"><i class="icon-twitter icon-2x"></i></li>
																<li class="count"> <?php echo $t->blogs_fetched;
																	if($i <= 5){if($t->blogs_fetched >= $stats[$i]->blogs_fetched)
																		{
																			echo '<i class="icon-arrow-up icon-large" style="color:green;">'.number_format ((($t->blogs_fetched - $stats[$i]->blogs_fetched) / $stats[$i]->blogs_fetched * 100), 2 ).'</i>';
																		}
																		else
																		{
																			echo '<i class="icon-arrow-down icon-large" style="color:red;">'.number_format ((($stats[$i]->blogs_fetched - $t->blogs_fetched) / $t->blogs_fetched * 100), 2 ).'</i>';
																		} }?></li>
															</ul>
														</div>
														<?php
															$i++; }
														?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>