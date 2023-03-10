<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bluedart extends CI_Controller {

	public function __construct(){
	    error_reporting(0);
        parent::__construct();
        $this->load->library(array('form_validation','session','cart'));
		//$this->load->database();
    }

	
	public function index(){
	    $ordernumber		 = 'ORDER1234'; // Unique Order ID
		$ActualWeight        = '0.5'; //kgs
		$CommodityDetail1    = 'CodyPaste T-shirt'; //Product Name
		$DeclaredValue       = '2000'; //Price

		$Breadth             = '14.1'; //in cms (centimeter)
		$Count               = '1'; // Number of products
		$Height              = '5.1'; //in cms (centimeter)
		$Length              = '32.8'; //in cms (centimeter)

		$CustomerAddress1 = '401, Living Homes';
		$CustomerAddress2 = 'Frineds Enclave';
		$CustomerAddress3 = 'Noida';

		$SpecialInstruction = 'N/A';

		$PickupDate = '2023-01-02'; // YY-MM-DD

		$CustomerEmailID = 'customer@email.com';
		$CustomerMobile = '9989898989';
		$CustomerName = 'Vipul Rai';
		$CustomerPincode = '201009';
		$ProductCode = 'D'; // D: Domestic, A: Air Apex, E: Express/surface
		
					   
		#echo "Start  of Soap 1.2 version (ws_http_Binding)  setting";
		$soap = new DebugSoapClient('https://netconnect.bluedart.com/Ver1.10/ShippingAPI/WayBill/WayBillGeneration.svc?wsdl',
						
		array(
			'trace' 		=> 1,  
			'style'			=> SOAP_DOCUMENT,
			'use'			=> SOAP_LITERAL,
			'soap_version' 	=> SOAP_1_2
		));
						
		$soap->__setLocation("https://netconnect.bluedart.com/Ver1.10/ShippingAPI/WayBill/WayBillGeneration.svc");

		$soap->sendRequest = true;
		$soap->printRequest = false;
		$soap->formatXML = true; 

		$actionHeader = new SoapHeader('http://www.w3.org/2005/08/addressing','Action','http://tempuri.org/IWayBillGeneration/GenerateWayBill',true);
		$soap->__setSoapHeaders($actionHeader);	
		#echo "end of Soap 1.2 version (WSHttpBinding)  setting";
					
					
	$params = array(
	'Request' => 
	array (
	'Consignee' =>
		array (
			'ConsigneeAddress1' 	=> 'Plot 23-24',
			'ConsigneeAddress2' 	=> 'Greno West',
			'ConsigneeAddress3'		=> 'Noida',
			'ConsigneeAttention'	=> 'A',
			'ConsigneeMobile'		=> '9999999999',
			'ConsigneeName'			=> 'Cody Paste',
			'ConsigneePincode'		=> '201009',
			'ConsigneeTelephone'	=> '9999999999',
		),
	'Services' => 
		array (
			'ActualWeight' 		=> $ActualWeight,
			'CollectableAmount' => '0',
			'Commodity' =>
				array (
					'CommodityDetail1' => $CommodityDetail1
			),
			'CreditReferenceNo' => $ordernumber,
			'DeclaredValue' 	=> $DeclaredValue,
			'Dimensions' =>
				array (
					'Dimension' =>
						array (
							'Breadth' => $Breadth,
							'Count' => $Count,
							'Height' => $Height,
							'Length' => $Length
						),
				),
				'RegisterPickup' 	=> true, 
				'InvoiceNo' 		=> substr(str_replace("-", "", $ordernumber), -10),
				'PackType' 			=> '',
				'PickupDate' 		=> $PickupDate,
				'PickupTime' 		=> '1800',
				'PieceCount' 		=> '1',
				'ProductCode' 		=> $ProductCode,
				'ProductType' 		=> 'Dutiables',
				'SpecialInstruction' => $SpecialInstruction,
				'SubProductCode' 	=> ''
		),
		'Shipper' =>
			array(
				'CustomerAddress1' 	=> $CustomerAddress1,
				'CustomerAddress2' 	=> $CustomerAddress2,
				'CustomerAddress3' 	=> $CustomerAddress3,
				'CustomerCode' 		=> '123456', // BlueDart will share Customer Code
				'CustomerEmailID' 	=> $CustomerEmailID,
				'CustomerMobile' 	=> $CustomerMobile,
				'CustomerName'      => $CustomerName,
				'CustomerPincode'   => $CustomerPincode,
				'CustomerTelephone' => $CustomerMobile,
				'IsToPayCustomer'   => true, // IsToPayCustomer if blank menas 'forward', if 'true' then it's reverse pickup.
				'OriginArea' 		=> 'DEL',
				'Sender' 			=> $CustomerName,
				'VendorCode' 		=> ''
			)
	),
	'Profile' => 
		array(
			'Api_type' 	=>'S',
			'LicenceKey'=>'XXXXkjhgkjhgjkhg87658765jkhg', // BlueDart will share
			'LoginID'	=>'MOZ1234', // BlueDart will share
			'Version'	=>'1.3'
		)
	);
	// Here I call my external function
	$result = $soap->__soapCall('GenerateWayBill',array($params));

	$blueDartResponse = $this->Bluedartmodel->blueDartResponse($result);
	
	if($blueDartResponse=="1"){
		//Generate Waybill PDF
		$x 					= $result->GenerateWayBillResult;
		$AWBPrintContent    = $x->AWBPrintContent;		
        if($AWBPrintContent==""){$AWBPrintContent="none";}
		?>
		  <object data="data:application/pdf;base64,<?php echo base64_encode($AWBPrintContent); ?>" type="application/pdf" style="height:100%;width:100%"></object>
		<?php
	}
	
	}
	
}



class DebugSoapClient extends SoapClient {
  public $sendRequest = true;
  public $printRequest = true;
  public $formatXML = true;

  public function __doRequest($request, $location, $action, $version, $one_way=0) {
    if ( $this->printRequest ) {
      if ( !$this->formatXML ) {
        $out = $request;
      }
      else {
        $doc = new DOMDocument;
        $doc->preserveWhiteSpace = false;
        $doc->loadxml($request);
        $doc->formatOutput = true;
        $out = $doc->savexml();
      }
      echo $out;
    }

    if ( $this->sendRequest ) {
      return parent::__doRequest($request, $location, $action, $version, $one_way);
    }
    else {
      return '';
    }
  }
}