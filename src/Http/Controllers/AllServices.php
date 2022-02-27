<?php

namespace Iamdevmaniac\Recordsapi\Http\Services;

use Iamdevmaniac\Recordsapi\traits\MasterTrait;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class AllServices {

    use MasterTrait;
    protected $apiUrl;
    protected $apiKey;
    protected $api_id;

    public function __construct()
    {
        $this->apiUrl = config("RECORDS_API_URL");
        $this->apiKey = config("RECORDS_APP_ID");
        $this->api_id = config("RECORDS_APP_KEY");
    }

    public function getUserIpAddr(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
     }

    public function getBirth($data)
    {
        return [
            "credentials"=> $this->getCredentials(),
            "catalogue"=> $data['catalogue'],
            "data" => [
                "FirstName"=> $data['firstName'],
                "LastName"=> $data['lastName'],
                "MiddleName"=> $data['middleName'],
                "State"=> $data['state'],
                "Country"=> $data['country'],
                "BirthYear"=> $data['birthYear'],
                "FamilyLastname"=> $data['familyLastname'],
                "ExactMatch"=> "Yes"
                ]
            ];
    }

    public function getCredentials()
    {
        return [
            "App_ID"=>  $this->apiKey,
            "APP_Key"=>  $this->apiKey,
            "Timestamp"=> time(),
            "IP"=> $this->getUserIpAddr()
        ];
    }

    public function getMarriage($data)
    {
        return [
            "credentials"=> $this->getCredentials(),
            "catalogue"=> $data['catalogue'],
            "data" => [
                "FirstName"=> $data['firstName'],
                "LastName"=> $data['lastName'],
                "MiddleName"=> $data['middleName'],
                "State"=> $data['state'],
                "Country"=> $data['country'],
                "MarriageYear"=> $data['MarriageYear'],
                "ExactMatch"=>"Yes"
                ]
            ];
    }

    public function getDivorce($data)
    {
        return [
            "credentials"=> $this->getCredentials(),
            "catalogue"=> $data['catalogue'],
            "data" => [
                "FirstName"=> $data['firstName'],
                "LastName"=> $data['lastName'],
                "MiddleName"=> $data['middleName'],
                "State"=> $data['state'],
                "Country"=> $data['country'],
                "BirthYear"=> $data['birthYear'],
                "FamilyLastname"=> $data['familyLastname'],
                "ExactMatch"=> "Yes"
                ]
            ];
    }

    public function getDeath($data)
    {
        return [
            "credentials"=> $this->getCredentials(),
            "catalogue"=> $data['catalogue'],
            "data" => [
                "FirstName"=> $data['firstName'],
                "LastName"=> $data['lastName'],
                "MiddleName"=> $data['middleName'],
                "State"=> $data['state'],
                "Country"=> $data['country'],
                "BirthYear"=> $data['birthYear'],
                "DeathYear"=> $data["deathYear"],
                "ExactMatch"=> "Yes"
                ]
            ];
    }


    public function usPeople($data)
    {
        return [
            "credentials"=> $this->getCredentials(),
            "catalogue"=> $data['catalogue'],
            "data" => [
                "FirstName"=> $data['firstName'],
                "LastName"=> $data['lastName'],
                "MiddleName"=> $data['middleName'],
                "State"=> $data['state'],
                "Country"=> $data['country'],
                "City"=> $data['city'],
                "ZipCode"=> $data["deathYear"],
                "ExactMatch"=> "Yes"
                ]
            ];
    }

    public function getBussiness($data)
    {
        return [
            "credentials"=> $this->getCredentials(),
            "catalogue"=> $data['catalogue'],
            "data" => [
                "FirstName"=> $data['firstName'],
                "LastName"=> $data['lastName'],
                "MiddleName"=> $data['middleName'],
                "State"=> $data['state'],
                "Country"=> $data['country'],
                "City"=> $data['city'],
                "ZipCode"=> $data["deathYear"],
                "ExactMatch"=> "Yes"
                ]
            ];
    }

    public function catalogues($data)
    {
        switch($data['catalogue']){
            case "BIRTH":
                return $this->getBirth($data);

            case "DEATH":
                return $this->getDeath($data);
            case "MARRIAGE":
                return $this->getMarriage($data);
            case "MORTGAGE":
                return $this->getBussiness($data);
            case "USPEOPLE":
                return $this->usPeople($data);
        }
    }


        public  function getData($data)
        {
            $data = $this->catalogues($data);

            $url = $this->apiUrl;
            $request = Http::post($url,  $data);
            $response = $request->json();
            if($response['status']['code']="200 OK"){
                return response()->json($this->success($response['response']));
            }
            return response()->json($this->error($response->statusCode));
        }
}
