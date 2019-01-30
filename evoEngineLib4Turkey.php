<?php
/**
 * Created by PhpStorm.
 * User: emre
 * Date: 23.11.2017
 * Time: 14:49
 */

class evoEngineLib4Turkey{

    function __construct()
    {

    }

    private function getJson2DArray($jsonFile){
        $finishArray = array();

        $jsonFile = @file_get_contents($jsonFile);
        $jsonArray = json_decode($jsonFile,true);

        foreach ($jsonArray as $key => $value){
            $finishArray[] = array($key,$value);
        }

        return($finishArray);
    }
    private function getJson2val($jsonFile,$key){

        $jsonFile = @file_get_contents($jsonFile);
        $jsonArray = json_decode($jsonFile,true);

        return($jsonArray[$key]);
    }

    function getDriverLicenceArray(){
        return($this->getJson2DArray('inc/evoEngineLib4Turkey/driverLicence.json'));
    }
    function getDriverLicence($licenceCode){
        return($this->getJson2val('inc/evoEngineLib4Turkey/driverLicence.json',$licenceCode));
    }

    function getCityArray(){
        return($this->getJson2DArray('inc/evoEngineLib4Turkey/citys.json'));
    }
    function getCity($cityCode){
        return($this->getJson2val('inc/evoEngineLib4Turkey/citys.json',$cityCode));
    }

    function getCitDistrictArray($cityCode){
        return($this->getJson2DArray('inc/evoEngineLib4Turkey/cityDistrict/'.$cityCode.'.json'));
    }
    function getCityDistrict($cityCode,$districtCode){
        return($this->getJson2val('inc/evoEngineLib4Turkey/cityDistrict/'.$cityCode.'.json',$districtCode));
    }

    function getCityDistrictMXArray($districtCode){
        $finishArray = array();

        $jsonFile = @file_get_contents('inc/evoEngineLib4Turkey/cityDistrictMX/'.$districtCode.'.json');
        $jsonArray = json_decode($jsonFile,true);

        foreach ($jsonArray as $key => $value){
            $finishArray[] = array($key,$value['name']);
        }

        return($finishArray);
    }
    function getCityDistrictMX($districtCode,$smCode){

        $jsonFile = @file_get_contents('inc/evoEngineLib4Turkey/cityDistrictMX/'.$districtCode.'.json');
        $jsonArray = json_decode($jsonFile,true);

        //print_r($jsonArray);

        return($jsonArray[$smCode]['name']);
    }

    function getCityDistrictSMArray($districtCode){

        $jsonFile = @file_get_contents('inc/evoEngineLib4Turkey/cityDistrictMX/'.$districtCode.'.json');
        $jsonArray = json_decode($jsonFile,true);

        //print_r($jsonArray);

        return($jsonArray);

    }

    function getCityDistrictMX2Array($districtCode,$semtCode){
        $finishArray = array();

        $jsonFile = @file_get_contents('inc/evoEngineLib4Turkey/cityDistrictMX/'.$districtCode.'.json');
        $jsonArray = json_decode($jsonFile,true);

        //print_r($jsonArray[$semtCode]['mah']);

        foreach ($jsonArray[$semtCode]['mah'] as $key => $value){
            $finishArray[] = array($value['id'],$value['name']);
        }

        return($finishArray);
    }

    function getCityDistrictMX2($districtCode,$semtCode,$mahCode){
        $finishArray = array();

        $jsonFile = @file_get_contents('inc/evoEngineLib4Turkey/cityDistrictMX/'.$districtCode.'.json');
        $jsonArray = json_decode($jsonFile,true);

        //print_r($jsonArray[$semtCode]['mah']);

        foreach ($jsonArray[$semtCode]['mah'] as $key => $value){
            $finishArray[$value['id']] = $value['name'];
        }

        return($finishArray[$mahCode]);
    }

    function getCitysTaxAdminsArray($city){

        $jsonFile = @file_get_contents('inc/evoEngineLib4Turkey/citysTaxAdministrations.json');
        $jsonArray = json_decode($jsonFile,true);

        $taxOffice = array();
        foreach ($jsonArray[$city] as $value){
            $taxOffice[] = (array($value[1],$value[2]));
        }
        return($taxOffice);
    }
    function getUniversity($id){
        return($this->getJson2val('inc/evoEngineLib4Turkey/university.json',$id));
    }

    function getUniversityArray(){
        return($this->getJson2DArray('inc/evoEngineLib4Turkey/university.json'));
    }

    function version(){
        return ("evoEngine Library For Turkey Version : ".$this->versionNo());
    }

    public function versionNo(){
        return ("1.1.8");
    }
}
