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
			<div class="span6">
				<div class="box">
					<div class="box-header">
						<span class="title">Latest News!</span>
					</div>
					<div style="height: 452px; overflow-y: auto" class="box-content scrollable">
						<?php foreach($news as $n) {?>
						<div class="box-section news with-icons">
							<div class="avatar blue"><i class="icon-ok icon-2x"></i></div>
							<div class="news-time">
								<span><?php echo date('j',$n->timestamp); ?></span> <?php echo date('M', $n->timestamp); ?>
							</div>
							<div class="news-content">
								<div class="news-title"><a href="<?php echo $n->link; ?>"><?php echo $n->title?></a></div>
								<div class="news-text"><?php echo $n->text; ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>