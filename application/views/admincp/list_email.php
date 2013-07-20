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
						<span class="title">Email Templates</span>
					</div>
					<table class="table table-normal">
						<thead>
							<tr>
								<td>ID</td>
								<td>Name</td>
								<td>Subject</td>
								<td style="width: 110px">Edit Template</td>
							</tr>
						</thead>

						<tbody>
							<?php foreach($email_templates as $e){ ?>
								<tr>
									<td class="icon"><?php echo $e->id; ?></td>
									<td><?php echo $e->name; ?></td>
									<td><?php echo $e->subject; ?></td>
									<td><?php echo anchor('admincp/email/edit_email/'.$e->id, 'Edit Template', 'class="btn btn-gray"');?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="pull-right">
					<?php echo anchor('admincp/email/add_template' ,'Add an Email Template', array('class'=>"btn btn-green")); ?>
				</div>
			</div>
		</div>
	</div>
</div>