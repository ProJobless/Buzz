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
				<?php if($invoice != 0) {?>
				<div class="box">
					<div class="box-header">
						<div class="title">Invoice - #HN-<?php echo $invoice[0]->id; ?></div>
					</div>
				<?php }?>