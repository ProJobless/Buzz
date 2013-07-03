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
		<?php
			if($this->process_model->is_invoice_due() == 1)
			{
		?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-header">
						<div class="title">Due Invoices</div>
					</div>

					<table class="table table-normal">
						<thead>
							<tr>
								<td style="width:100px;">ID</td>
								<td>Plan</td>
								<td style="width: 100px">Amount</td>
								<td style="width: 100px">Generation Data</td>
								<td style="width: 100px">Due date</td>
								<td style="width: 90px">Pay</td>
							</tr>
						</thead>

						<tbody>
							<?php foreach($this->process_model->get_due_invoices() as $i) {?>
								<tr class="">
									<td style="text-align:center;">#HN-<?php echo $i->id; ?></td>
									<td><?php echo $this->process_model->get_plan_by_id($i->plan); ?></td>
									<td style="text-align:center;">$<?php echo  number_format($i->amount, 2); ?></td>
									<td style="text-align:center;"><?php echo date('M j, Y, h:i A', $i->time_generated); ?></td>
									<td style="text-align:center;"><?php echo date('M j, Y, h:i A', strtotime("+15 days", $i->time_generated)); ?></td>
									<td><a href="<?php echo site_url('headquarters/billing/pay_invoice')."/".$i->id;?>" class="btn btn-blue">Pay now</a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					

				</div>
			</div>
		</div>
		<?php } ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-header">
						<div class="title">Invoices</div>
					</div>

					<table class="table table-normal">
						<thead>
							<tr>
								<td style="width:100px;">ID</td>
								<td>Plan</td>
								<td style="width: 100px">Amount</td>
								<td style="width: 100px">Generation Data</td>
								<td style="width: 100px">Paid on</td>
								<td style="width: 110px">View</td>
							</tr>
						</thead>

						<tbody>
							<?php foreach($invoices as $i) { if($i->paid == 1) {?>
								<tr class="">
									<td style="text-align:center;">#HN-<?php echo $i->id; ?></td>
									<td><?php echo $this->process_model->get_plan_by_id($i->plan); ?></td>
									<td style="text-align:center;">$<?php echo  number_format($i->amount, 2); ?></td>
									<td style="text-align:center;"><?php echo date('M j, Y, h:i A', $i->time_generated); ?></td>
									<td style="text-align:center;"><?php echo date('M j, Y, h:i A', $i->time_paid); ?></td>
									<td><a href="<?php echo site_url('headquarters/billing/view_invoice')."/".$i->id;?>" class="btn btn-green">View Invoice</a></td>
								</tr>
							<?php }} ?>
						</tbody>
					</table>
					

				</div>
			</div>
		</div>
	</div>
</div>