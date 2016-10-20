<html>
	<head> 
		<style type="text/css">
			@page {
			    margin-top: .5cm;
			    margin-bottom: .5cm;
			    margin-left: 1cm;
			    margin-right: 1cm;
			}
		</style>
	</head>

	<body>
		<div style="border:1px solid; width:1000px;">
			<div style="width:80px; float:left;">
				<img src="/assets/img/bir_logo.png" style="width:90px; height:90px; padding:10px;">
			</div>

			<div style="width:180px; font-size:11px; margin-top:20px; font-family:Arial; float:left; margin-right:-10px;">
				Republika ng Pilipinas<br/>
				Kagawaran ng Pananalapi<br/>
				Kawanihan ng Rentas Internas
			</div>

			<div style="width:200px; font-family:Arial; text-align:center; margin-top:-20px; float:left;">
				<h3>Monthly Percentage <br/> Tax Return</h3>
			</div>

			<div style="width:200px; font-family:Arial; margin-top:15px; text-align:center;">
				<span style="font-size:11px;">BIR Form No.</span><br/>
				<span style="font-size:19px; font-weight:bold;">2551M</span><br/>
				<span style="font-size:11px;">September 2005 (ENCS)</span>
			</div>
		</div>
		
		<div style="border:1px solid; font-family:Arial; width:1000px; font-size:11px; margin-top:5px;">
			<div style="padding-left:5px;">Fill in all applicable spaces. Mark all appropriate boxes with an “X”.</div>
		</div>

		<div style="border:1px solid; width:1000px; background-color:#c0c0c0;">
			<table>
			<tr>
				<td style="border-right:1px solid; width:250px;">
					<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
						<div>
                        <span style="font-weight:bold;">1</span> For the 
                            <input type="checkbox"/ <?php echo $calendarYear; ?> > Calendar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox"/ <?php echo $fiscalYear; ?> > Fiscal</div>
						<div><span style="font-weight:bold;">2</span> Year ended (MM/YYYY)
                            <!-- YEAR END-->
                            <input type="text" value="<?php show($fiscal_year); ?>"> 
                        <span style="color:#c0c0c0;"><span></div>
					</div>
				</td>

				<td style="border-right:1px solid; width:150px;">
					<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
						<div>
							<span style="font-weight:bold;">3</span> For the month<br/>
							<span style="">(MM/YYYY)
                                <!-- FOR MONTH-->
                                <input type="text" value="<?php show($for_month); ?>">
                            <span style="color:#c0c0c0;"><span>
						</div>
					</div>
				</td>

				<td style="border-right:1px solid; width:120px; padding-top:-9px;">
					<div style="font-family:Arial; font-size:11px; padding-left:10px;">
						<div>
							<span style="font-weight:bold;">4</span> Amended Return<br/>
							<span>
                                <input type="checkbox" <?php echo $amendedYes; ?> > Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" <?php echo $amendedNo; ?> > No
                            <span>
						</div>
					</div>
				</td>

				<td>
					<div style="font-family:Arial; font-size:11px; padding-left:10px; padding-top: 5px;">
						<div><span style="font-weight:bold;">5</span> Number of sheets attached 
                        <input type="text" value="3"> <span style="color:#c0c0c0;"><span></div>
					</div>
				</td>
			</tr>
			</table>
		</div>	
		
		<!-- BASIC INFORMATION -->
		<?php include(APPPATH.'/views/pdf/2551M/part-1.php'); ?>
		<!-- COMPUTATION OF TAX -->
		<?php include(APPPATH.'/views/pdf/2551M/part-2.php'); ?>
		<!-- DETAILS OF PAYMENT -->
		<?php include(APPPATH.'/views/pdf/2551M/part-3.php'); ?>

		<div style="margin-top:25px; border:1px solid; width:1000px; font-size:11px; background-color:#c0c0c0; font-family:Arial; border-bottom:1px solid;">
			<table>
				<tr>
					<td style="width:300px;">
						<div style="font-family:Arial; font-size: 11px; padding-left:5px; font-weight:bold;">Schedule 1</div>
					</td>

					<td>
						<div style="font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">Tax Withheld Claimed as Tax Credit</div>
					</td>
				</tr>
			</table>
		</div>	

		<div style="border:1px solid; width:1000px; font-size:11px; font-family:Arial; border-bottom:1px solid;">
			<table>

				<tr style="background-color:#c0c0c0; ">
					<td style="border-right:1px solid; border-bottom:1px solid; width:100px; text-align:center;">
						<div style="font-family:Arial; font-size: 11px; font-weight:bold;">Period Covered</div>
					</td>

					<td style="border-right:1px solid; border-bottom:1px solid; width:200px; text-align:center;">
						<div style="font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">Name of Withholding Agent</div>
					</td>

					<td style="border-right:1px solid; border-bottom:1px solid; width:150px; text-align:center;">
						<div style="font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">Income Payments</div>
					</td>

					<td style="border-right:1px solid; border-bottom:1px solid; width:131px; text-align:center;">
						<div style="font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">Tax Withheld</div>
					</td>

					<td style="width:150px; text-align:center; border-bottom:1px solid;">
						<div style="font-family:Arial; font-size: 11px; font-weight:bold;">Applied</div>
					</td>
				</tr>

				<tr>
					<td style="border-right:1px solid; border-bottom:1px solid; width:100px; text-align:center;">
						<br/>
					</td>

					<td style="border-right:1px solid; border-bottom:1px solid; width:200px; text-align:center;">
						<br/>
					</td>

					<td style="border-right:1px solid; border-bottom:1px solid; width:150px; text-align:center;"></td>

					<td style="border-right:1px solid; border-bottom:1px solid; width:100px; text-align:center;"></td>

					<td style="width:100px; border-bottom:1px solid; text-align:center;"></td>
				</tr>
			</table>
		</div>

		<div style="border:1px solid; width:1000px; font-size:11px; font-family:Arial; border-bottom:1px solid;">
			<table>

				<tr>
					<td style="background-color:#c0c0c0; width:300px;">
						<div style="font-family:Arial; font-size: 11px; font-weight:bold;">Total (To Item 20A)</div>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>	

		<div style="border:0px solid; width:1000px; font-size:11px; font-family:Arial; text-align:center; ">
			<div style="font-family:Arial; font-size: 11px; font-weight:bold;">ALPHANUMERIC TAX CODE (ATC)</div>
		</div>
		
		<!-- table heading -->
		<div style="float:left; width:364px; border:1px solid;">
			<table>
                <tr>
                    <td style="text-align:center; width:50px;">
                    	<div style="font-family:Arial; font-size: 11px; font-weight:bold;">ATC</div>
                    </td>
                    <td style="text-align:center; width:230px;">
                    	<div style="font-family:Arial; font-size: 11px; font-weight:bold; "> Percentage Tax On: </div>
                    </td>
                    <td style="text-align:center; width:80px;">
                    	<div style="font-family:Arial; font-size: 11px; font-weight:bold; "> Tax Rate </div>
                    </td>
                </tr>
    		</table>
    	</div>

    	<div style="float:left; width:350px; border:1px solid;">
			<table>
                <tr>
                    <td style="text-align:center; width:50px;">
                    	<div style="font-family:Arial; font-size: 11px; font-weight:bold;">ATC</div>
                    </td>
                    <td style="text-align:center; width:200px;">
                    	<div style="font-family:Arial; font-size: 11px; font-weight:bold; "> Percentage Tax On: </div>
                    </td>
                    <td style="text-align:center; width:80px;">
                    	<div style="font-family:Arial; font-size: 11px; font-weight:bold; "> Tax Rate </div>
                    </td>
                </tr>
    		</table>
    	</div>
    	<!--table heading -->


    	<!-- table left -->
		<div style="float:left; width:364px; border:1px solid;">
			<table style="">
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;">PT 010</div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Persons exempt from VAT under Sec. 109v (Sec. 116) </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 3% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid;">
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;">PT 040 </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Domestic carriers and keepers of garages </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 3% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid;">
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;">PT 041  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> International Carriers </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 3% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid;">
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 060  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Franchises on gas and water utilities </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 2% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid;">
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 070  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Franchises on radio/TV broadcasting companies whose annual gross receipts do not exceed P 10 M </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 3% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid; font-family:Arial; font-size: 11px;">
                <tr>
                    <td> Tax on banks and non-bank financial intermediaries performing quasi banking functions </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;"></div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> 1) On interest, commissions and discounts from lending activities as well as income from financial leasing, on the basis of remaining maturities of instruments from  which such receipts are derived</div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 105  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Maturity period is five (5) years or less </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 5% </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 101  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Maturity period is more than five (5) years </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 1% </div>
                    </td>
                </tr>
    		</table>

    		<table style="margin-bottom:23px;">
                <tr>
                    <td style="width:50px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 102  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> 2) On dividends and equity shares and net income of subsidiaries </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 0% </div>
                    </td>
                </tr>
    		</table>
    	</div>
    	<!--table left -->

    	<!--table right -->
    	<div style="float:left; width:350px; border:1px solid;">
			<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 103 3) </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> On royalties, rentals of property, real or personal, profits from exchange and all other gross income </div>
                    </td>
                    <td style="width:80px;text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 7% </div>
                    </td>
                </tr>

                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 104 4) </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> On net trading gains within the taxable year on foreign currency, debt securities, derivatives, and other financial instruments </div>
                    </td>
                    <td style="width:80px;text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 7% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid; font-family:Arial; font-size: 11px;">
                <tr>
                    <td> Tax on Other Non-Bank Financial Intermediaries not performing quasi-banking functions </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"></div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> 1) On interest, commissions and discounts from lending activities as well as income from financial leasing, on the basis of remaining maturities of instruments from  which such receipts are derived</div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 113 </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Maturity period is five (5) years or less </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 5% </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 114 </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Maturity period is more than five (5) years </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 1% </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 115 2) </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> From all other items treated as gross income under the code </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 5% </div>
                    </td>
                </tr>
    		</table>

    		<table style="border-top:1px solid; border-bottom:1px solid;">
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 070  </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> Life Insurance premium </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 5% </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="font-family:Arial; font-size: 11px;"> Agents of Foreign Insurance Companies </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 130 </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> a) Insurance Agents </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 10% </div>
                    </td>
                </tr>
    		</table>

    		<table>
                <tr>
                    <td style="width:60px;">
                    	<div style="font-family:Arial; font-size: 11px;"> PT 132 </div>
                    </td>
                    <td style="width:230px;">
                    	<div style="font-family:Arial; font-size: 11px;"> b) Owners of property obtaining insurance directly with foreign insurance companies </div>
                    </td>
                    <td style="width:80px; text-align:center; ">
                    	<div style="font-family:Arial; font-size: 11px;"> 5% </div>
                    </td>
                </tr>
    		</table>
    	</div>

    	<!--table right -->




    	<pagebreak></pagebreak>

    	<div style="float:left; width:1000px; font-family:Arial; font-size: 11px; text-align:center; font-weight:bold;">
    		<div style="margin-top:25px;">BIR Form No. 2551M Percentage Tax Return Guidelines and Instructions</div>
    	</div>

    	<div style="float:left; width:310px; font-family:Arial; font-size: 11px; padding-right:10px;">
    		<div style="margin-top:25px;"><b>Who Shall File</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div style="padding-left:15px;">This return shall be filed in triplicate by the following:</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">1.</div>
    				<div style="float:left;">Persons whose gross annual sales and/or receipts do not exceed P1,500,000 and who are not VAT-registered person</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">2.</div>
    				<div style="float:left;">Domestic carriers and keepers of garages, except owners of bancas and owners of animal-drawn two wheeled vehicle.</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">3.</div>
    				<div style="float:left;">Operators of international air and shipping carriers doing business in the Philippines.</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">4.</div>
    				<div style="float:left;">Franchise grantees of gas or water utilities</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">5.</div>
    				<div style="float:left;">Franchise grantees of radio and/or television broadcasting companies whose gross annual receipts of the preceding year do not exceed Ten Million Pesos (P10,000,000.00) and did not opt to register as VAT taxpayers.</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">6.</div>
    				<div style="float:left;">Banks, non-bank financial intermediaries and finance companies.</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">7.</div>
    				<div style="float:left;">Life insurance companies.</div>
    			</li>

    			<li>
    				<div style="padding-right:5px; float:left; width:10px;">8.</div>
    				<div style="float:left;">Agents of foreign insurance companies.</div>
    			</li>
    		</ul>

    		<div style="margin-top:25px;"><b>When and Where to File</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div>The return shall be filed not later than the 20th day following the end of each month. Any person retiring from a business subject to percentage taxes shall notify the nearest Revenue District Office, file his return and pay the tax due thereon within twenty (20) days after closing his business.</div>
    			</li><br/>

    			<li>
    				<div>The return shall be filed with any Authorized Agent Bank (AAB) within the territorial jurisdiction of the Revenue District Office where the taxpayer is required to register/conducting business. In places where there are no AABs, the return shall be filed with the Revenue Collection Officer or duly Authorized City or Municipal Treasurer within the Revenue District Office where the taxpayer is required to register/conducting business.</div>
    			</li><br/>

    			<li>
    				<div>A taxpayer may, at his option, file a separate return for the head office and for each branch or place of business or a consolidated return for the head office and all the branches except in the case of large taxpayers where only one consolidated return is required.</div>
    			</li><br/>
    		</ul>

    		<div style="margin-top:25px;"><b>When and Where to Pay</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div>Upon filing this return, the total amount payable shall be paid to the Authorized Agent Bank (AAB) where the return is filed. In places where there are no AABs, payment shall be made directly to the Revenue Collection Officer or duly Authorized City or Municipal Treasurer who shall issue a Revenue Official Receipt BIR Form No. 2524) therefor.
    				</div>
    			</li><br/>

    			<li>
    				<div>Where the return is filed with an AAB, taxpayer must accomplish and submit BIR-prescribed deposit slip, which the bank teller shall machine validate as evidence that payment was received by the AAB. The AAB receiving the tax return shall stamp mark the word “Received” on the return and also machine validate the return as proof of filing the return and payment of the tax by the taxpayer, respectively. The machine validation shall reflect the date of payment, amount paid and transactions code, the name of the bank, branch code, teller’s code and teller’s initial. Bank debit memo number and date should be indicated in the return for taxpayers paying under the bank debit system.</div>
    			</li>
    		</ul>
    	</div>


    	<div style="float:left; width:350px; font-family:Arial; font-size: 11px;">
    		<div style="margin-top:25px; margin-left:15px;"><b>For Electronic Filing and Payment System (EFPS) Taxpayer</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div style="padding-left:15px;">The deadline for electronically filing and paying the taxes due thereon shall be in accordance with the provisions of existing applicable revenue issuances.</div>
    			</li>
    		</ul>

    		<div style="margin-left:15px;"><b>Basis of Tax</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div style="padding-left:15px;">The tax is based on gross sales, receipts or earnings except on insurance companies where the basis of tax is the total premium collected/paid.</div>
    			</li>
    		</ul>

    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div style="padding-left:15px;">"Gross receipts" means all amounts received by the prime or principal contractor, undiminished by any amount paid to any subcontractor under a subcontract arrangement.</div>
    			</li>
    		</ul>

    		<div style="margin-left:15px;"><b>Penalties</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li>
    				<div style="padding-left:15px;">There shall be imposed and collected as part of the tax:</div>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">1.</div>
    				<div style="float:left;">A surcharge of twenty five percent (25%) for each of the following violations:</div>

    				<ul style="list-style:none; margin-left:-25px;">
    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">a.</div>
    						<div style="float:left;">Failure to file any return and pay the amount of tax or installment due on or before the due date;</div>
    					</li>

    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">b.</div>
    						<div style="float:left;">Unless otherwise authorized by the Commissioner, filing a return with a person or office other than those with whom it is required to be filed;</div>
    					</li>

    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">c.</div>
    						<div style="float:left;">Failure to pay the full or part of the amount of tax shown on the return, or the full amount of tax due for which no return is required to be filed on or before the due date;</div>
    					</li>

    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">d.</div>
    						<div style="float:left;">Failure to pay the deficiency tax within the time prescribed for its payment in the notice of assessment</div>
    					</li>
    				</ul>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">2.</div>
    				<div style="float:left;">A surcharge of fifty percent (50%) of the tax or of the deficiency tax, in case any payment has been made on the basis of such return before the discovery of the falsity or fraud, for each of the following violations:</div>

    				<ul style="list-style:none; margin-left:-25px;">
    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">a.</div>
    						<div style="float:left;">Willful neglect to file the return within the period prescribed by the Code or by rules and regulations; or</div>
    					</li>

    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">b.</div>
    						<div style="float:left;">In case a false or fraudulent return is willfully made.</div>
    					</li>
    				</ul>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">3.</div>
    				<div style="float:left;">Interest at the rate of twenty percent (20%) per annum, or such higher rate as may be prescribed by rules and regulations, on any unpaid amount of tax from the date prescribed for the payment until the amount is fully paid</div>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">4.</div>
    				<div style="float:left;">Compromise penalty.</div>
    			</li>
    		</ul>

    		<div style="margin-left:15px;"><b>Attachments Required</b></div>
    		<ul style="list-style:none; margin-left:-40px;">
    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">1.</div>
    				<div style="float:left;">Certificate of Creditable Tax Withheld at Source, if applicable;</div>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">2.</div>
    				<div style="float:left;">Duly approved Tax Debit Memo, if applicable;</div>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">3.</div>
    				<div style="float:left;">For amended return, proof of the payment and the return previously filed;</div>
    			</li>

    			<li style="margin-left:15px;">
    				<div style="padding-right:5px; float:left; width:10px;">4.</div>
    				<div style="float:left;">All returns filed by an authorized representative must attach authorization letter.</div>
    			</li>
    		</ul>

    		<div style="margin-left:15px;"><b>Note: All background information must be properly filled up.</b></div>
    		<ul style="margin-left:-40px;">
    			<li style="margin-left:28px;">All returns filed by an accredited tax representative on behalf of a taxpayer shall bear the following information:
    				<ul style="list-style:none; margin-left:-25px;">
    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">A.</div>
    						<div style="float:left;">For CPAs and others (individual practitioners and members of GPPs);</div>

    						<ul style="list-style:none; margin-left:-25px;">
		    					<li>
		    						<div style="padding-right:5px; float:left; width:10px;">a.1 &nbsp;</div>
		    						<div style="float:left;"> &nbsp; Taxpayer Identification Number (TIN); and </div>
		    					</li>

		    					<li>
		    						<div style="padding-right:5px; float:left; width:10px;">a.2 &nbsp;</div>
		    						<div style="float:left;"> &nbsp; Certificate of Accreditation Number, Date of Issuance, and Date of Expiry.</div>
		    					</li>
		    				</ul>
    					</li>

    					<li>
    						<div style="padding-right:5px; float:left; width:10px;">B.</div>
    						<div style="float:left;"> For members of the Philippine Bar (individual practitioners, members of GPPs):</div>

    						<ul style="list-style:none; margin-left:-25px;">
		    					<li>
		    						<div style="padding-right:5px; float:left; width:10px;">b.1 &nbsp;</div>
		    						<div style="float:left;"> &nbsp; Taxpayer Identification Number (TIN); and </div>
		    					</li>

		    					<li>
		    						<div style="padding-right:5px; float:left; width:10px;">b.2 &nbsp;</div>
		    						<div style="float:left;"> &nbsp; Attorney’s Roll Number or Accreditation Number, if any.</div>
		    					</li>
		    				</ul>
    					</li>
    				</ul>
    			</li>

    			<li style="margin-left:28px;">Nos. 1, 2 and 3 of this form refer to transaction period and not the date of filing this return.</li>

    			<li style="margin-left:28px;">The last 3 digits of the 12-digit TIN refers to the branch code.</li>

    			<li style="margin-left:28px;">TIN = Taxpayer Identification Number</li>
    		</ul>
    	</div>

    	<div style="float:right; width:50px; font-family:Arial; font-size: 11px;">
    		ENCS<br/>
			2551M
    	</div>
	</body>
</html>