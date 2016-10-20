<pagebreak></pagebreak>

<div style="border:1px solid; font-size:11px;">
	<div style="background-color:#c0c0c0; float:left; width:550px; border-right:1px solid;">
		<div style="font-family:Arial; font-size: 11px; padding-left:5px; font-weight:bold; border-bottom:1px solid;"><div style="float:left; width:300px;">Part III</div> <div>Details of Payment</div></div>
		<div>
		<table>
            <tr>
                <td style="text-align:center; border-bottom:1px solid; border-right:1px solid;">
                	<div style="font-family:Arial; font-size: 11px; font-weight:bold;">Particulars</div>
                </td>
                <td style="text-align:center; border-bottom:1px solid; border-right:1px solid;">
                	<div style="font-family:Arial; font-size: 11px; font-weight:bold; "> Drawee Bank/ Agency </div>
                </td>
                <td style="text-align:center; border-bottom:1px solid; border-right:1px solid;">
                	<div style="font-family:Arial; font-size: 11px; font-weight:bold; ">Number</div>
                </td>
                <td style="text-align:center; border-bottom:1px solid; border-right:1px solid;">
                	<div style="font-family:Arial; font-size: 11px; font-weight:bold; ">Date <br/> MM/DD/YYYY</div>
                </td>
                <td style="text-align:center; border-bottom:1px solid; ">
                	<div style="font-family:Arial; font-size: 11px; font-weight:bold; ">Amount</div>
                </td>
            </tr>

            <tr>
                <td>
                	<div style="font-family:Arial; font-size: 11px; "> <b>27</b>  Cash/Bank</div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>27A</b> 
                        <input type="text" value="<?php echo show($payment['cash']['agency']);?>"> 
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>27B</b> 
                        <input type="text" value="<?php echo show($payment['cash']['number']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>27C</b> 
                        <input type="text" value="<?php echo show($payment['cash']['date']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>27D</b> 
                        <input type="text" value="<?php echo show($payment['cash']['amount']);?>">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                	<div style="font-family:Arial; font-size: 11px; "> Debit Memo</div>
                </td>
            </tr>

            <tr>
                <td>
                	<div style="font-family:Arial; font-size: 11px; "> <b>28</b>  Check</div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>28A</b> 
                        <input type="text" value="<?php echo show($payment['check']['agency']);?>"> 
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>28B</b>
                        <input type="text" value="<?php echo show($payment['check']['number']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>28C</b> 
                        <input type="text" value="<?php echo show($payment['check']['date']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>28D</b> 
                        <input type="text" value="<?php echo show($payment['check']['amount']);?>">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                	<div style="font-family:Arial; font-size: 11px; "> <b>29</b>  Tax Debit</div>
                </td>
                <td></td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>29A</b> 
                        <input type="text" value="<?php echo show($payment['tax']['number']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>29B</b> 
                        <input type="text" value="<?php echo show($payment['check']['date']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>29C</b> 
                        <input type="text" value="<?php echo show($payment['check']['amount']);?>">
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                	<div style="font-family:Arial; font-size: 11px; "> Memo</div>
                </td>
            </tr>

            <tr>
                <td>
                	<div style="font-family:Arial; font-size: 11px; "> <b>30</b>  Others</div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>30A</b> 
                        <input type="text" value="<?php echo show($payment['others']['agency']);?>"> 
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>30B</b> 
                        <input type="text" value="<?php echo show($payment['others']['number']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>30C</b> 
                        <input type="text" value="<?php echo show($payment['others']['date']);?>">
                    </div>
                </td>
                <td style="text-align:center;">
                	<div style="font-family:Arial; font-size: 11px; "> <b>30D</b> 
                        <input type="text" value="<?php echo show($payment['others']['amount']);?>">
                    </div>
                </td>
            </tr>
        </table>
        </div>
	</div>

	<div style="float:left">
		<div style="font-family:Arial; font-size: 11px; text-align:center; padding-top:50px;">Stamp of Receiving Office/AAB and Date of Receipt (RO's Signature/ Bank Teller's Initial)</div>
	</div>
</div>

<div style="width:977px; border-left:1px solid; border-right:1px solid; border-top:0px solid; border-bottom:1px solid; font-family:Arial; font-size:11px; padding-left:5px; padding-top:5px; padding-bottom:5px;">

	<div>Machine Validation/Revenue Official Receipt Details (If not filed with an Authorized Agent Bank)</div>
	<div>
		<br/>
	</div>
</div>