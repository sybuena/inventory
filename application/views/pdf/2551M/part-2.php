<div style="border:1px solid; width:1000px; font-size:11px; background-color:#c0c0c0;">
	<table>
		<tr>
			<td style="width:280px;">
				<div style="font-family:Arial; font-size: 11px; padding-left:5px; font-weight:bold;">Part II</div>
			</td>

			<td>
				<div style="font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">Computation of Tax</div>
			</td>
		</tr>
	</table>
</div>

<div style="border:1px solid; width:1000px; border-bottom:0; font-size:12px; background-color:#c0c0c0; padding-left:10px; padding-top:5px;">
	<table>
		<thead>
            <tr>
                <th style="width:170px; text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; ">Taxable Transaction / Industry Classification</div>
                </th>
                <th style="width:140px; text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; "> ATC </div>
                </th>
                <th style="width:130px; text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; ">Taxable Amount</div>
                </th>
                <th style="width:120px; text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; ">Tax Rate</div>
                </th>
                <th style="width:130px; text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; ">Tax Due</div>
                </th>
            </tr>
        </thead>

        <tbody>
        	<?php foreach($computation as $k => $v):?>
				<tr>
					<td style=" font-family:Arial; font-size:11px; text-align:center;">
						<span style="font-weight:bold; "></span>
						<input style="width:130px;" type="text" value="<?php show($v['name']);?>">
					</td>

					<td style=" font-family:Arial; font-size:11px;text-align:center;">
						<span style="font-weight:bold; "></span>
						<input type="text" value="<?php show($v['tax_code']);?>">
					</td>

					<td style=" font-family:Arial; font-size:11px;text-align:center;">
						<span style="font-weight:bold; "></span>
						<input type="text" value="<?php formatMoney(show($v['value']), 1);?>">
					</td>

					<td style=" font-family:Arial; font-size:11px;text-align:center;">
						<span style="font-weight:bold; "></span>
						<input type="text" value="<?php show($v['tax_rates']);?>">
					</td>

					<td style=" font-family:Arial; font-size:11px;text-align:center;">
						<span style="font-weight:bold; "></span>
						<input type="text" value="<?php formatMoney(show($v['calculated']), 1);?>">
					</td>
				</tr>
			<?php endforeach;?>

		</tbody>
	</table>
</div>

<div style="background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:18px; padding-bottom:2px; padding-top:5px;">
	<div style="width:410px; font-family:Arial; font-size: 11px; padding-left:5px; float:left;"><b>19</b>&nbsp;&nbsp; Total Tax Due</div>
	<div style="font-family:Arial; font-size: 11px; font-weight:bold; text-align:right; padding-right:28px;">19 
		<input type="text" style="width:76px;" value="<?php show($computation_total); ?>">
	</div>
</div>

<div style="margin-top:-5px;width: 977px; background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:23px; padding-bottom:2px;">
	<b>20</b> Less: Tax Credits/Payments</div>
</div>

<div style="background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:38px; padding-bottom:5px;">
	<div style="width:410px; font-family:Arial; font-size: 11px; padding-left:5px; float:left;"><b>20A</b> Creditable Percentage Tax Withheld Per BIR Form No. 2307 (See Schedule 1)</div>
	<div style="font-family:Arial; font-size: 11px; font-weight:bold; text-align:right; padding-right:28px;">20A <input type="text" style="width:76px;"></div>
</div>

<div style="background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:38px; padding-bottom:5px;">
	<div style="width:410px; font-family:Arial; font-size: 11px; padding-left:5px; float:left;"><b>20B</b> Tax Paid in Return Previously Filed, if this is an Amended Return</div>
	<div style="font-family:Arial; font-size: 11px; font-weight:bold; text-align:right; padding-right:28px;">20B <input type="text" style="width:76px;"></div>
</div>

<div style="background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:18px; padding-bottom:5px;">
	<div style="width:410px; font-family:Arial; font-size: 11px; padding-left:5px; float:left;"><b>21</b> Total Tax Credits/Payments (Sum of Items 20A & 20B)</div>
	<div style="font-family:Arial; font-size: 11px; font-weight:bold; text-align:right; padding-right:28px;">21 <input type="text" style="width:76px;"></div>
</div>

<div style="background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:18px; padding-bottom:5px;">
	<div style="width:410px; font-family:Arial; font-size: 11px; padding-left:5px; float:left;"><b>22</b> Tax Payable (Overpayment) (Item 19 less Item 21)</div>
	<div style="font-family:Arial; font-size: 11px; font-weight:bold; text-align:right; padding-right:28px;">22 <input type="text" style="width:76px;"></div>
</div>

<div style="border:1px solid; border-top:0px; width:1000px; border-bottom:0; font-size:12px; background-color:#c0c0c0; padding-left:10px; padding-top:5px; padding-bottom:5px;">
	<table>
		<thead>
            <tr>
                <td style="width:130px;">
                	<div style="font-family:Arial; font-size: 11px; ">&nbsp;&nbsp;&nbsp;<b>23</b> Add: Penalties</div>
                </td>
                <td style="width:150px; text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; "> Surcharge </div>
                </td>
                <td style="width:130px;text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; ">Interest</div>
                </td>
                <td style="width:150px;text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; ">Compromise</div>
                </td>
                <td style="width:130px;text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; padding-left:5px; "></div>
                </td>
            </tr>
        </thead>

        <tbody>
        	<tr>
				<td style="width:130px; font-family:Arial; font-size:11px;text-align:center;">
					<!-- <span style="font-weight:bold; ">18A</span><input type="text"> -->
				</td>

				<td style="width:130px; font-family:Arial; font-size:11px;text-align:center;">
					<span style="font-weight:bold; ">23A</span><input type="text">
				</td>

				<td style="width:130px; font-family:Arial; font-size:11px; text-align:center;">
					<span style="font-weight:bold; ">23B</span><input type="text">
				</td>

				<td style="width:130px; font-family:Arial; font-size:11px; text-align:center;">
					<span style="font-weight:bold; ">23C</span><input type="text">
				</td>

				<td style="width:130px; font-family:Arial; font-size:11px; text-align:center;">
					<span style="font-weight:bold; ">23D</span><input type="text">
				</td>
			</tr>
        </tbody>
    </table>
</div>

<div style="background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; font-family:Arial; font-size:11px; padding-left:18px; padding-bottom:5px;">
	<div style="width:410px; font-family:Arial; font-size: 11px; padding-left:5px; float:left;"><b>24</b> Total Amount Payable/(Overpayment) (Sum of Items 22 and 23D)</div>
	<div style="font-family:Arial; font-size: 11px; font-weight:bold; text-align:right; padding-right:26px;">24 <input type="text" style="width:76px;"></div>
</div>

<div style="width: 977px; background-color:#c0c0c0; border-left:1px solid; border-right:1px solid; border-bottom:1px solid; font-family:Arial; font-size:11px; padding-left:23px; padding-bottom:5px;">
	If overpayment, mark one box only: <input type="checkbox"> To be Refunded &nbsp;&nbsp;&nbsp;<input type="checkbox"> To be issued a Tax Credit Certificate</div>
</div>

<div style="width: 977px; border-bottom: 0px; border-left:1px solid; border-right:1px solid; border-top:1px solid; font-family:Arial; font-size:11px; padding-left:23px; padding-bottom:5px; padding-top:5px;">
	I declare, under the penalties of perjury, that this return has been made in good faith, verified by me, and to the best of my knowledge, and belief,is true and correct, pursuant to the provisions of the National Internal Revenue Code, as amended, and the regulations issued under authority thereof.
</div>

<div style="width: 977px; border-left:1px solid; border-right:1px solid; border-top:0px solid; font-family:Arial; font-size:11px; padding-left:23px; padding-bottom:2px; padding-top:2px;">

	<div style="float:left; width:400px;">
		<b>25</b> <input type="text" style="width:350px;">
		<div style="margin-left:30px; float:left;">President/Vice President/Principal Officer/Accredited Tax Agent/</div> 
		<div style="text-align:center;">Authorized Representative/Taxpayer </div>
		<div style="text-align:center;">(Signature Over Printed Name)</div>
	</div>

	<div style="float:left; margin-left:58px;">
		<b>26</b> <input type="text" style="width:167px;">
		<div style="margin-left:30px;">Treasurer/Assistant Treasurer</div> 
		<div style="margin-left:30px;">(Signature Over Printed Name)</div>
	</div>
</div>

<div style="width: 977px; border-left:1px solid; border-right:1px solid; border-top:0px solid; font-family:Arial; font-size:11px; padding-left:23px; padding-top:2px;">

	<div style="float:left; width:400px;">
		<div style="width:200px; float:left;">
			<b></b> <input type="text" style="width:170px;">
			<div style="margin-left:30px; float:left;">Title/Position of Signatory</div>
		</div>

		<div style="width:200px; float:left;">
			<b></b> <input type="text" style="width:170px;">
			<div style="margin-left:45px; float:left;">TIN of Signatory </div>
		</div>
	</div>

	<div style="float:left; margin-left:61px;">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width:165px;">
		<div style="margin-left:39px;">Title/Position of Signatory</div>
	</div>
</div>

<div style="width:977px; border-left:1px solid; border-right:1px solid; border-top:0px solid; border-bottom:1px solid; font-family:Arial; font-size:11px; padding-left:5px; padding-top:5px; padding-bottom:5px;">

	<div style="float:left; width:380px;">
		<div style="width:250px; float:left;">
			<b></b> <input type="text" style="width:230px;">
			<div style="float:left;">Tax Agent Acc. No./Atty's Roll No.(if applicable)</div>
		</div>

		<div style="width:130px; float:left; margin-left:-5px;">
			<b></b> <input type="text" style="width:100px;">
			<div style="margin-left:10px; float:left;">Date of Issuance</div>
		</div>
	</div>

	<div style="width:130px; float:left; margin-left:-20px;">
		<b></b> <input type="text">
		<div style="float:left; margin-left:6px;">Date of Expiry</div>
	</div>

	<div style="float:left; padding-right:5px;">
		<input type="text" style="width:200px;">
		<div style="margin-left:45px;">TIN of Signatory</div>
	</div>
</div>