<html>
	<head> 
		<style type="text/css">
			@page {
			    margin-top: .5cm;
			    margin-bottom: .5cm;
			    margin-left: 1cm;
			    margin-right: 1cm;
			}
			
			.center {
				text-align: center;
			}
			.f-s-10 {
				font-size: 10px
			}
			.f-s-12 {
				font-size: 12px
			}
			.pull-right {
				float: right;
			}
			.pull-left {
				float: left;
			}
			table {
				border:1px solid black;
				border-collapse:collapse;
			}
			td, th {
			    border: 1px solid black;
			    text-align: left;
			}
			.t-r {
				text-align: right;
			}
		</style>
	</head>
	<body>
		<img src="http://dev.apgars-inventory.com/assets/img/circle-logo.png" width="100">
		<div class="header center pull-left" style="margin-top: -98px">
			<h3>Aquarian Power Generation And Repair Services</h3>
			<p class="f-s-10">
				Unit 2, G/F Dona Lolita Bldg. 298 J. Teodora St., 10th Ave.,<br>
				Brgy. 062, Caloocan City<br>
				Tel Nos. (0632) 709-7927 / 986-4619; Fax No. (0632) 990-1896<br>
				<b><u>www.apgars.com.ph</u></b> <br>
			</p>
		</div>
		<div class="clearfix"></div>
		<h5 class="t-r">No : <?=$info['order_number']; ?></h5>
		<h4 class="center">Purchase Order</h4>
		
		<div style="width: 50%" class="pull-left">
			<p class="f-s-12">
				Supplier : <?=$supplier['company_name'];?><br>
				Address : <?=$supplier['address'].' '.$supplier['city'].', '.$supplier['province'];?> <br>
				Tel No : <?=$supplier['mobile'];?><br>
				Attn : <br>
				Code : <?=$supplier['account_number'];?><br>
			</p>
		</div>
		<div style="width: 50%"  class="pull-left">
			<p class="f-s-12">
				Date : <?=$info['date']; ?><br>
				Terms : <br>
				Fax No : <br>
				Reference : <?=$info['reference_number']; ?><br>
				Delivery : <?=$info['due_date']; ?><br>
			</p>
		</div>
		
		<p class="f-s-12" style="margin-top: -5px">
			Please order and immediately deliver the following items according to our agreed terms & condition
		</p>
		<table>
			<thead>
				<tr>
					<th width="200" class="center">ITEM</th>
					<th width="300" class="center">DESCRIPTION</th>
					<th width="50" class="center">QTY</th>
					<th width="150" class="center">UNIT PRICE</th>
					<th width="150" class="center">TOTAL PRICE</th>
				<tr>
			</thead>
			<tbody>
				<?php foreach($info['line'] as $v) :?>
					<tr>
						<td><?=$v['name']?></td>
						<td><?=$v['description']?></td>
						<td><?=$v['quantity']?></td>
						<td class="t-r"><?=money($v['rate'])?></td>
						<td class="t-r"><?=money($v['amount'])?></td>
					</tr>
				<?php endforeach;?>
				<?php foreach($info['service'] as $v) :?>
					<tr>
						<td><?=$v['name']?></td>
						<td><?=$v['description']?></td>
						<td><?=$v['quantity']?></td>
						<td class="t-r"><?=money($v['rate'])?></td>
						<td class="t-r"><?=money($v['amount'])?></td>
					</tr>
				<?php endforeach;?>
				<?php foreach($info['other'] as $v) :?>
					<tr>
						<td><?=$v['name']?></td>
						<td><?=$v['description']?></td>
						<td><?=$v['quantity']?></td>
						<td class="t-r"><?=money($v['rate'])?></td>
						<td class="t-r"><?=money($v['amount'])?></td>
					</tr>
				<?php endforeach;?>
				<tr>
					<td colspan="2"> <b>Grand Total Php</b> </td>
					<td colspan="3" class="t-r">
						<?=money($info['total_amount'])?>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div style="width: 80%">
			<p class="f-s-12">NOTE :</p>
			<p class="f-s-10">
			1. Our Company has the right not to accept or reject all delivered goods if it is not within the required delivery and specification as previously negotiated.</p>
			<p class="f-s-10">2. All deliveries having defect or damage will not be accepted and should be replaced immediately  to avoid penalty.
			</p>
		</div>
		<div>
			<p class="f-s-12">Prepared By :</p>
			<p class="f-s-12">Requested By :</p>
		</div>
	</body>
</html>