<?php

namespace Iamdevmaniac\Recordsapi\traits;

trait MasterTrait {

    /**
     * success response with 200
     *
     * @return void
     */
    public function success($data){
        return [
            "status"=>"200",
            "data"=>$data
        ];
    }


    public function error($code=404){

        switch($code){
            case 404:
                return  $this->response($code,"Invalid AppID/AppKEY");
                break;
            case 500:
                return  $this->response($code,"Account Deactivated/Suspended. Contact support");
                break;
            case 504:
                return  $this->response($code,"Catalogue Value Mismatched! Follow the Troubleshooting Guide in API USAGE MANUAL");
                break;
            case 600:
                return  $this->response($code,"Check values under data node. Last Name is a Mandatory Field");
                break;
            case 601:
                return  $this->response($code,"No more available calls left as your subscribed Plan. Renew your plan");
                break;
            case 602:
                return  $this->response($code,"Plan Expired. Renew your plan to continue");
                break;
            case 603:
                return  $this->response($code,"Invalid Mandatory Field Pattern Detected. Check the [LastName] Field!");
                break;
            case 604:
                return  $this->response($code,"Invalid Request Pattern Detected! Specify the [State] Name");
                break;
            case 605:
                return  $this->response($code,"Invalid Request Pattern Detected! [State] Name is Blank");
                break;
            case 606:
                return  $this->response($code,"Invalid Request Pattern Detected! First/Middle/Last Name is Invalid");
                break;
            case 608:
                return  $this->response($code,"Invalid Request Pattern Detected! State is Invalid");
                break;
            case 609:
                return  $this->response($code,"Invalid Request Pattern Detected! County is Invalid");
                break;
            case 611:
                return  $this->response($code,"Invalid Request Pattern Detected! Specify the State Name/Family Name is Invalid");
                break;
            case 612:
                return  $this->response($code,"Invalid Request Pattern Detected! Name is too short");
                break;
            case 614:
                return  $this->response($code,"Invalid Request Pattern Detected! Slang/offensive word");
                break;
            case 615:
                return  $this->response($code,"Invalid Request Pattern Detected! Slang/Offensive Word in Family Name");
                break;
            case 681:
                return  $this->response($code,"Invalid Request Pattern Detected! Birth Year is Invalid");
                break;
            case 682:
                return  $this->response($code,"Invalid Request Pattern Detected! Birth Year is Invalid.");
                break;
            case 683:
                return  $this->response($code,"Invalid Request Pattern Detected! Birth Year is Invalid (Same Year or Year from Future)");
                break;
            case 684:
                return  $this->response($code,"Invalid Request Pattern Detected! Birth Year is Invalid");
                break;
            default:
                return $this->response(422, "OPPS AN ERROR OCCURED IN REQUEST");
        }

    }

    public function response($code,$message){
        return [
            "status"=>$code,
            "message"=>$message
        ];
    }


}
