<?php form_open(); ?>
<div class="ls_container">
	<div class="box">
		<div class="box-header">HypeNinja - Register</div>
		<div class="box-content">
			<div class="span9">
				<div class="breadcrumb">
					<ul>
						<li><a>Register</a></li>
						<li class="active"><a>Payment</a></li>
					</ul>
				</div>
				<h1>Payment</h1>
				<div class="pay_button">
					<form action="https://www.sandbox.paypal.com/us/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_xclick-subscriptions">
						<input type="hidden" name="business" value="aayushranaut@gmail.com">
						<input type="hidden" name="return"
						value="http://www.liquidserve.com/hypeninja/thankyou.htm">
						<input type="hidden" name="cancel_return"
						value="http://www.liquidserve.com/cancel.htm">
						<input type="hidden" name="a3" value="<?php echo number_format($plan_data->price,2); ?>">
						<input type="hidden" name="p3" value="1">
						<input type="hidden" name="t3" value="M">
						<input type="hidden" name="src" value="1">
						<input type="hidden" name="sra" value="1">
						<input type="hidden" name="no_note" value="1">
						<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
						<input type="hidden" value="http://www.liquidserve.com/hypeninja/headquarters/process/ipn" name="notify_url">
						<button class="paypal" type="submit">Pay with Paypal</button>
					</form>
				</div>
			</div>	
			<div class="span3">
				<h1>Tips</h1>
				<ul>
					<li>We currently accept only Paypal.</li>
					<li>More tips soon! or maybe testimonials!</li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div
		
	</div>
</div>