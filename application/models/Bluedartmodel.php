<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bluedartmodel extends CI_Model {
    public function __construct(){
		$this->load->library('session');
		$this->load->library('email');
        $this->load->database();
    }
   
   public function blueDartResponse($result){
       date_default_timezone_set("Asia/Kolkata"); 
        $x = $result->GenerateWayBillResult;
        //$y = $x->AWBPrintContent;
                
        $AWBNo                          = $x->AWBNo;
        if($AWBNo==""){$AWBNo="none";}
        $AWBPrintContent                = $x->AWBPrintContent;
        if($AWBPrintContent==""){$AWBPrintContent="none";}
        $AvailableAmountForBooking      = $x->AvailableAmountForBooking;
        if($AvailableAmountForBooking==""){$AvailableAmountForBooking="none";}
        $AvailableBalance               = $x->AvailableBalance;
        if($AvailableBalance==""){$AvailableBalance="none";}
        $CCRCRDREF                      = $x->CCRCRDREF;
        if($CCRCRDREF==""){$CCRCRDREF="none";}
        $DestinationArea                = $x->DestinationArea;
        if($DestinationArea==""){$DestinationArea="none";}
        $DestinationLocation            = $x->DestinationLocation;
        if($DestinationLocation==""){$DestinationLocation="none";}
        $IsError                        = $x->IsError;
        if($IsError==""){$IsError="none";}
        $IsErrorInPU                    = $x->IsErrorInPU;
        if($IsErrorInPU==""){$IsErrorInPU="none";}
        $ShipmentPickupDate             = $x->ShipmentPickupDate;
        if($ShipmentPickupDate==""){$ShipmentPickupDate="none";}
        
        $Status_WayBill_StatusCode      = $x->Status->WayBillGenerationStatus->StatusCode;
        if($Status_WayBill_StatusCode==""){$Status_WayBill_StatusCode="none";}
        $Status_Pickup_StatusCode       = $x->Status->WayBillGenerationStatus->StatusInformation;
        if($Status_Pickup_StatusCode==""){$Status_Pickup_StatusCode="none";}
        $TokenNumber                    = $x->TokenNumber;
        if($TokenNumber==""){$TokenNumber="none";}
        $TransactionAmount              = $x->TransactionAmount;
        if($TransactionAmount==""){$TransactionAmount="none";}
        $rmanumber                      = $CCRCRDREF;
        if($rmanumber==""){$rmanumber="none";}
        $date                           = date("Y-m-d H:i:sA");
        $status                         = '1';
        
        $datas = array(
    		'AWBNo'                         => $AWBNo,
    		'AWBPrintContent'               => $AWBPrintContent,
    		'AvailableAmountForBooking'     => $AvailableAmountForBooking,
    		'AvailableBalance'              => $AvailableBalance,
    		'CCRCRDREF'                     => $CCRCRDREF,
    		'DestinationArea'               => $DestinationArea,
    		'DestinationLocation'           => $DestinationLocation,
    		'IsError'                       => $IsError,
    		'IsErrorInPU'                   => $IsErrorInPU,
    		'ShipmentPickupDate'            => $ShipmentPickupDate,
    		'Status_WayBill_StatusCode'     => $Status_WayBill_StatusCode,
    		'Status_Pickup_StatusCode'      => $Status_Pickup_StatusCode,
    		'TokenNumber'                   => $TokenNumber,
    		'TransactionAmount'             => $TransactionAmount,
    		'rmanumber'                     => $rmanumber,
    		'date'                          => $date,
    		'status'                        => $status,
    		'full_result'                   => serialize($result)
        );
        if($this->db->insert('bluedart_response',$datas)){
            return 1;
        }
       
        
       
   }


}