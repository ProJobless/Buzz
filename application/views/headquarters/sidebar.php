<div class="primary-sidebar">
	<ul class="nav nav-collapse collapse nav-collapse-primary">
		<li class="active">
			<span class="glow"></span>
			<a href="<?php echo site_url('headquarters/dashboard'); ?>">
				<span>Dashboard</span>
			</a>
		</li>
		
		<li class="">
			<span class="glow"></span>
			<a href="<?php echo site_url('campaign/manager'); ?>">
				<span>Campaigns</span>
			</a>
		</li>
		
		<li class="">
			<span class="glow"></span>
			<a href="<?php echo site_url('headquarters/settings'); ?>">
				<span>Settings</span>
			</a>
		</li>
	</ul>

    <hr style="margin-top: 60px" class="divider">

	<div class="sparkline-box side">

		<div class="sparkline-row">
			<h4 class="gray"><span>Orders</span> 847</h4>
		</div>

		<hr class="divider">
		<div class="sparkline-row">
			<h4 class="dark-green"><span>Income</span> $43.330</h4>
			<div data-color="darkGreen" class="sparkline big"><canvas style="display: inline-block; width: 82px; height: 30px; vertical-align: top;" width="82" height="30"></canvas>
			</div>
		</div>

		<hr class="divider">
		<div class="sparkline-row">
			<h4 class="blue"><span>Reviews</span> 223</h4>
			<div data-color="blue" class="sparkline big"><canvas style="display: inline-block; width: 82px; height: 30px; vertical-align: top;" width="82" height="30"></canvas>
			</div>
		</div>

		<hr class="divider">
	</div>
</div>