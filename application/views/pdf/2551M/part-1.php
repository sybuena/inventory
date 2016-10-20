
<div style="border:1px solid; width:1000px; font-size:11px; background-color:#c0c0c0;">
	<table>
		<tr>
			<td style="width:280px;">
				<div style="font-family:Arial; font-size: 11px; padding-left:5px; font-weight:bold;">Part I</div>
			</td>

			<td>
				<div style="font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">Background Information</div>
			</td>
		</tr>
	</table>
</div>	

<div style="border:1px solid; width:1000px; background-color:#c0c0c0;">
	<table>
		<tr>
			<td style="border-right:1px solid; width:150px;">
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div><span style="font-weight:bold;">6</span> TIN 
						<!-- TIN NUMBER -->
						<input type="text" value="<?php show($tin); ?>" style="width:100px;">
					</div>
				</div>
			</td>

			<td style="border-right:1px solid; width: 180px;">
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div><span style="font-weight:bold;">7</span> RDO Code 
						<input type="text" value="<?php show($rdo_code); ?>">
					</div>
				</div>
			</td>

			<td>
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div><span style="font-weight:bold;">8</span> Line of Business / Occupation 
						<input type="text" value="<?php show($bussiness); ?>" style="width:210px;">
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

<div style="border:1px solid; width:1000px; background-color:#c0c0c0;">
	<table>
		<tr>
			<td style="border-right:1px solid;">
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div>
						<span style="font-weight:bold;">9</span> Taxpayer's Name (For Individual)Last Name, First Name, Middle Name/(For Non-individual) Registered Name
						<input type="text" style="width:430px;" value="<?php show($owner['name']); ?>">
					</div>
				</div>
			</td>

			<td style="width:120px;">
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div><span style="font-weight:bold;">10</span> Telephone Number 
						<input type="text" value="<?php show($owner['phone']); ?>">
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

<div style="border:1px solid; width:1000px; background-color:#c0c0c0;">
	<table>
		<tr>
			<td style="border-right:1px solid;">
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div><span style="font-weight:bold;">11</span> Registered Address
						<input type="text" style="width:430px;" value="<?php show($owner['address']); ?>">
					</div>
				</div>
			</td>

			<td>
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div><span style="font-weight:bold;">12</span> Zip Code 
						<input type="text" value="<?php show($owner['zip']); ?>">
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

<div style="border:1px solid; width:1000px; background-color:#c0c0c0;">
	<table>
		<tr>
			<td>
				<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
					<div>
						<span style="font-weight:bold;">13</span> Are you availing of tax relief under Special Law or International Tax Treaty?
						<input type="checkbox"/> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"/> No<br/>
						If Yes, Please specify <input type="textarea" style="width:300px;">
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>