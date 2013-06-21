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
						<span class="title">Twitter History</span>
						<ul class="box-toolbar">
							<li></li>
						</ul>
					</div>
					<div class="box-content">
						<table class="table table-normal">
							<thead>
								<tr>
									<td>Tweet</td>
									<td>Submitted</td>
								</tr>
							</thead>
	
							<tbody>
								<?php foreach($history as $h){ ?>
									<tr>
										<td><?php echo $h->tweet; ?></td>
										<td><?php if($h->scheduled == 0)
											{
												echo '<i class="icon-check"></i>';
											}
											else
											{
												echo "Scheduled";
											} ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->pagination->create_links(); ?>