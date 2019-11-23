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
		<img src="/assets/img/circle-logo.png" style="width:100px">
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
		<h5 class="t-r">No : <?=$info['quote_number']; ?></h5>
		<h4 class="center">Sales Quote</h4>
		
		<div style="width: 50%" class="pull-left">
			<p class="f-s-12">
				Quote To : <?=$customer['company_name'];?><br>
				TIN : <?=$customer['tin_number'];?><br>
				Address : <?=$customer['address'].' '.$customer['city'].', '.$customer['province'];?> <br>
				Bussiness Style : <?=$customer['bussiness_style'];?><br>
			</p>
		</div>
		<div style="width: 50%"  class="pull-left">
			<p class="f-s-12">
				Date : <?=$info['date']; ?><br>
				Expiry : <?=$info['due_date']; ?><br>
				Reference Number : <?=$info['ref_number']; ?> <br>
			</p>
		</div>
		
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
		
		<div style="width: 80%; margin-top: 20">
			<p class="f-s-12"><b>TITLE:</b></p>
			<p class="f-s-8">
				<?=$info['title'];?>
			</p>
		</div>

		<div style="width: 80%;">
			<p class="f-s-12"><b>SUMMAY/NOTE:</b></p>
			<p class="f-s-8">
				<?=$info['summary'];?>
			</p>
		</div>

		<div style="width: 80%;">
			<p class="f-s-12"><b>TERMS:</b></p>
			<p class="f-s-8">
				<?=$info['terms'];?>
			</p>
		</div>

		<div class="pull-right">
			<p class="f-s-12"><b>Issued By :</b></p>
		</div>
	</body>
</html>