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
			<div class="span4">
				<div class="box">
					<div class="box-header">
						<span class="title">Twitter Ninja</span>
					</div>
					<div style="height: 252px; overflow-y: auto" class="box-content scrollable">
						<?php foreach($tweet_ninja as $t) {?>
						<div class="box-section news with-icons">
							<div class="avatar cyan"><i class="icon-twitter icon-2x"></i></div>
							<div class="news-time">
								<span><?php echo date('j',$t->timestamp); ?></span> <?php echo date('M', $t->timestamp); ?>
							</div>
							<div class="news-content">
								<div class="news-title"><a href="<?php echo $t->tweet_url; ?>">@<?php echo $t->tweeter_name; ?></a></div>
								<div class="news-text"><?php echo $t->tweet; ?></div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="box">
					<div class="box-header">
						<span class="title">Facebook Ninja</span>
					</div>
					<div style="height: 252px; overflow-y: auto" class="box-content scrollable">
						
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="box">
					<div class="box-header">
						<span class="title">Blog Ninja</span>
					</div>
					<div style="height: 252px; overflow-y: auto" class="box-content scrollable">
						<?php foreach($blog_ninja as $b) {?>
						<div class="box-section news with-icons">
							<div class="avatar green"><i class="icon-book icon-2x"></i></div>
							<div class="news-time">
								<span><?php echo date('j',$b->timestamp); ?></span> <?php echo date('M', $b->timestamp); ?>
							</div>
							<div class="news-content">
								<div class="news-title"><a href="<?php echo $b->link; ?>"><?php echo $b->title; ?></a></div>
								
							</div>
						</div>
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div>
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