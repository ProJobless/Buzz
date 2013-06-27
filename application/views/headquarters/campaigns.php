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
						<div class="title">Campaigns</div>
					</div>
					<table class="table table-normal">
						<thead>
							<tr>
								<td></td>
								<td>Campaign Name</td>
								<td>Keywords</td>
								<td style="width: 50px">Edit</td>
								<td style="width: 60px">Manage</td>
								<td style="width: 70px">History</td>
								<td style="width: 70px">Delete</td>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; foreach($campaign_data as $c) {?>
								<tr class="">
									<td class="icon"><?php echo $i; ?></td>
									<td><?php echo $c->name; ?></td>
									<td><?php echo $c->keywords; ?></td>
									<td><a href="<?php echo site_url('campaign/manager/edit')."/".$c->id;?>" class="btn btn-pink">Edit</a></td>
									<td><a href="<?php echo site_url('campaign/buzz/twitter')."/".$c->id;?>" class="btn btn-blue">Manage</a></td>
									<td><a href="<?php echo site_url('campaign/manager/history')."/".$c->id;?>" class="btn btn-gray">History</a></td>
									<td><a href="<?php echo site_url('campaign/manager/delete')."/".$c->id;?>" class="btn btn-red">Delete</a></td>
								</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					<?php echo anchor('campaign/manager/add_campaign' ,'Add a Campaign', array('class'=>"btn btn-green")); ?>
				</div>
			</div>
		</div>
	</div>
</div>