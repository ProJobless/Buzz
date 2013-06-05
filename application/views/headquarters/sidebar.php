<div class="primary-sidebar">
	<ul class="nav nav-collapse collapse nav-collapse-primary">
		<li class="active">
			<span class="glow"></span>
			<a href="dashboard.html">
				<span>Dashboard</span>
			</a>
		</li>
		
		<li class="dark-nav ">
			<span class="glow"></span>
			
			<a href="#s1" data-toggle="collapse" class="accordion-toggle collapsed ">
				<span>Campaign 1</span>
			</a>
			<ul class="collapse " id="s1">
				<li class="">
					<?php echo anchor('campaign/stats','Stats'); ?>
				</li>
				<li class="">
					<?php echo anchor('campaign/buzz','Buzz'); ?>
				</li>
				<li class="">
					<?php echo anchor('campaign/settings','Settings'); ?>
				</li>
			</ul>
		</li>
	</ul>

    <hr style="margin-top: 60px" class="divider">

    <div class="sparkline-box side">

      <div class="sparkline-row">
        <h4 class="gray"><span>Orders</span> 847</h4>
        <div data-color="gray" class="sparkline big"><canvas style="display: inline-block; width: 82px; height: 30px; vertical-align: top;" width="82" height="30"></canvas></div>
      </div>

      <hr class="divider">
      <div class="sparkline-row">
        <h4 class="dark-green"><span>Income</span> $43.330</h4>
        <div data-color="darkGreen" class="sparkline big"><canvas style="display: inline-block; width: 82px; height: 30px; vertical-align: top;" width="82" height="30"></canvas></div>
      </div>

      <hr class="divider">
      <div class="sparkline-row">
        <h4 class="blue"><span>Reviews</span> 223</h4>
        <div data-color="blue" class="sparkline big"><canvas style="display: inline-block; width: 82px; height: 30px; vertical-align: top;" width="82" height="30"></canvas></div>
      </div>

      <hr class="divider">
    </div>
  </div>


</div>