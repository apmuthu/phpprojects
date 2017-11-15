<?php

$debug = false;

if ($debug) {
	$AgreementName = 'Mystery Shopper Agreement and Application';
	$Contractor = 'Alpha Marketing & Management Services Pvt. Ltd.';
	$ContractorRef = 'AMMSPL';
	$ContractorLoc = 'Chennai';
	$ContractorType = 'Company';
	$Buyer = 'Mr. / Ms. Shopper';
	$BuyerRef = 'Shopper';
	$BuyerRes = 'Buyer Address, City, State, Country, Zip';
	$ServiceDesc = <<<EOZ
the business of providing 
customer insight programs to it's clients, by means of, but not limited to,
mystery shopper reports and audits, using varying methods such as on site visits, 
telecommunication, web-based and intercept interviews
EOZ;
	$Service = 'Assignments';
	$Service_singular = 'Assignment';
	$Liability = "her/his own liability and workman's compensation, insurance and any other dues as applicable";
	$PayDate = '30th (thirtieth) of the next month';
	$Jurisdiction = 'Chennai';
} else {
	extract($_POST);
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $Contractor; ?> <?php echo $AgreementName; ?></title>
</head>

<body bgcolor="#FFFFFF">

<b><u><?php echo $Contractor; ?> <?php echo $AgreementName; ?></u></b>

<p>This agreement will govern the
relationship between <u><b><?php echo $Buyer; ?></b></u> residing at <u><?php echo $BuyerRes; ?></u> hereinafter referred to as the '<u><?php echo $BuyerRef; ?></u>', 
and, <u><b><?php echo $Contractor; ?></b></u>, a <?php echo $ContractorLoc; ?> based <?php echo $ContractorType; ?>,
hereinafter referred to as '<u><?php echo $ContractorRef; ?></u>'.
<br>
<br>
<?php echo $ContractorRef; ?> is engaged in <?php echo $ServiceDesc; ?> 
(hereinafter referred to as '<u><?php echo $Service; ?></u>'). 
The said resulting reports are provided to our clients for the purpose of
determining operational successes and opportunities in areas such
as service, sales, product presentation, facility maintenance,
and other specifics of the clients' operations and personnel. 
<br>
<br>
<?php echo $ContractorRef; ?> is looking for individuals to undertake such <?php echo $Service; ?> 
and The <?php echo $BuyerRef; ?> agrees to the following terms and conditions in
accepting <?php echo $Service; ?> from <?php echo $ContractorRef; ?>: <br>
<br>
RELATIONSHIP: The <?php echo $BuyerRef; ?> understands that <?php echo $ContractorRef; ?> is an
independent contractor and the <?php echo $BuyerRef; ?> is responsible for 
<?php echo $Liability; ?>, and holds <?php echo $ContractorRef; ?> harmless for any default,
during the term of the relationship. It is agreed and accepted
that there is NO employer - employee relationship between the
<?php echo $BuyerRef; ?> and <?php echo $ContractorRef; ?>. 
<br>
<br>
<?php echo strtoupper($Service); ?>: <?php echo $Service; ?> are scheduled by varying means as needed 
and on a rotating basis. The <?php echo $BuyerRef; ?> may choose to accept or 
reject any proposed <?php echo $Service_singular; ?>. The <?php echo $BuyerRef; ?> agrees and 
understands that <?php echo $ContractorRef; ?> shall have the sole right, option and 
choice to accept the <?php echo $BuyerRef; ?>s offer to undertake the <?php echo $Service_singular; ?> 
and the <?php echo $BuyerRef; ?> shall be bound by the decision of <?php echo $ContractorRef; ?>. It is
further clarified that the <?php echo $BuyerRef; ?> shall not be currently 
employed by any business/company which is related to the 
<?php echo $Service_singular; ?>. In addition, the <?php echo $BuyerRef; ?> confirms that the <?php echo $BuyerRef; ?> 
has not been in employment during the past year at any 
business/company relating to the <?php echo $Service_singular; ?>. The <?php echo $BuyerRef; ?> agrees
and undertakes that the <?php echo $BuyerRef; ?> will not apply for any
<?php echo $Service; ?> associated with the <?php echo $BuyerRef; ?>'s current or former 
employer and agrees and confirms that doing so will be in direct 
conflict with this agreement. 
<br>
<br>
COMPENSATION: Cheques for mystery shopping conducted in the month
will be disbursed only after receiving a complete audit report,
data, and all such documents as may be required within one days
of the <?php echo $Service_singular; ?> being completed. A bill for the service
rendered and the bill for Spend Amount (Spend Amount for the
purpose of this Agreement is defined as the amount of money the
<?php echo $BuyerRef; ?> may be allowed to spend for the purpose of the <?php echo $Service_singular; ?> 
being expenses on purchase of goods, services, and / or other 
expenses related specifically for the purpose of the <?php echo $Service_singular; ?> 
and as allowed / permitted by the quality coordinator, who will 
coordinate with the <?php echo $BuyerRef; ?> for the <?php echo $Service_singular; ?>) for the 
<?php echo $Service_singular; ?> undertaken must be sent within 4 working days and on 
completion of the <?php echo $Service_singular; ?>. <?php echo $ContractorRef; ?> shall pay the same by the 
<?php echo $PayDate; ?> provided all <?php echo $Service; ?> are 
received as per the set guidelines. The payment shall be subject 
to any adjustments / deductions as a result of late, incomplete, 
or inaccurate reports or if instructional guidelines are not met 
and shall be at the sole discretion of <?php echo $ContractorRef; ?> and the <?php echo $BuyerRef; ?> 
shall be bound by the decision of <?php echo $ContractorRef; ?>. It is further 
clarified that any expenses beyond that amount allowed / 
permitted by the quality coordinator, will not be reimbursed. It 
is understood that upon discontinuation / termination of this 
Agreement from the position of Agent, that any and all materials 
<?php echo $ContractorRef; ?> provided will be returned upon demand. Any compensation due 
and payable to the Agent may be withheld until all said material 
is received.
<br>
<br>
All statutory taxes will be deducted from payments made but no 
deductions will be made from reimbursements for each mystery 
shopping exercise conducted and the agreed spend amount.
<br>
<br>
The <?php echo $BuyerRef; ?>, hereby AGREES ,PROMISES and UNDERTAKES to: 
<br>
<br>
1. Keep confidential all findings regarding <?php echo $ContractorRef; ?> or <?php echo $ContractorRef; ?> 
clients, either verbally or in writing. The reports, findings, 
documents etc., are for the EXCLUSIVE use and knowledge of <?php echo $ContractorRef; ?> 
clients. The <?php echo $BuyerRef; ?>, acknowledges that any disclosure to third 
parties without <?php echo $ContractorRef; ?>'s explicit and prior written consent may 
warrant legal action; 
<br>
<br>
2. Not disclose the names and/or locations of <?php echo $ContractorRef; ?> clients; 
<br>
<br>
3. NEVER directly or indirectly contact a <?php echo $ContractorRef; ?> client at any 
level including unit management or personnel regarding the 
<?php echo $Service_singular; ?> results of said <?php echo $Service; ?> or for ANY reason 
related to services and relationship with <?php echo $ContractorRef; ?>; 
<br>
<br>
4. Never to use any <?php echo $ContractorRef; ?> materials for purposes other than the 
mutually agreed-upon <?php echo $Service_singular; ?>. All forms & training 
material are copyright protected and remain the exclusive 
property of <?php echo $ContractorRef; ?> and/or its clients and <?php echo $ContractorRef; ?> shall be 
entitled to take such action against the <?php echo $BuyerRef; ?> as may be deemed 
fit by <?php echo $ContractorRef; ?> in case any contravention;
<br>
<br>
5. For a term of one year after discontinuation of services by 
<?php echo $ContractorRef; ?>, the <?php echo $BuyerRef; ?> agrees NOT to enter any service evaluation 
business, either directly or indirectly. 
<br>
<br>
<br>
<br>
This agreement falls under the jurisdiction of the <?php echo $Jurisdiction; ?> courts. 
<br>
<br>
<u><b>UNDERTAKING</b></u> <br>
<br>
I, <u><b><?php echo $Buyer; ?></b></u>, DO UNDERSTAND THAT SIGNING OF THIS AGREEMENT
DOES NOT ENTITLE ME TO BECOME A <b><?php echo $BuyerRef; ?></b> AUTOMATICALLY. IT IS
UNDERSTOOD THAT THE APPOINTMENT IS SUBJECT TO CONFIRMATION BY
<b><?php echo $ContractorRef; ?></b> AND <b><?php echo $ContractorRef; ?></b> SHALL HAVE THE SOLE RIGHT TO DECIDE THE
APPOINTMENT OF THE <b><?php echo $BuyerRef; ?></b>. ON RECEIPT OF CONFIRMATION I AGREE TO
COMPLETE, TRANSMIT AND ACCEPT FOLLOW-UP REQUESTS FOR REPORTS AND
RECEIPTS ON ACCEPTED <b><?php echo $Service; ?></b> IN A PROFESSIONAL MANNER. <br>
<br>
<br>
</p>
</body>
</html>
