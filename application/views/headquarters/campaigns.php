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
								<td style="width: 100px">Edit</td>
								<td style="width: 100px">Manage</td>
								<td style="width: 100px">Delete</td>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; foreach($campaign_data as $c) {?>
								<tr class="">
									<td class="icon"><?php echo $i; ?></td>
									<td><?php echo $c->name; ?></td>
									<td><?php echo $c->keywords; ?></td>
									<td><a href="<?php echo site_url('campaign/manager/edit')."/".$c->id;?>" class="btn btn-pink">Edit</a></td>
									<td><a href="<?php echo site_url('campaign/buzz/index')."/".$c->id;?>" class="btn btn-blue">Manage</a></td>
									<td><a href="<?php echo site_url('headquarters/campaign/delete')."/".$c->id;?>" class="btn btn-red">Delete</a></td>
								</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>