<?php
/**
 * Created by PhpStorm.
 * User: Evosis
 * Date: 23.11.2017
 * Time: 14:49
 *
 * 2019-07-05 1.14
 * add checkNationalityId
 * fix getCityTaxAdminsArray
 * add getCityTaxAdminName
 *
 * 2019-07-10 1.16
 * add checkTaxNumber
 *
 * 2019-07-11 1.18
 * add checkTaxOrTC
 * fix checkTaxNumber
 */

class evoEngineLib4Turkey{

    function __construct()
    {
    }

    private function getJsonArray($jsonFile){

        $jsonFile = @file_get_contents($jsonFile);
        $jsonArray = json_decode($jsonFile,true);

        return($jsonArray);
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
    function getCityArrayKey(){
        return($this->getJsonArray('inc/evoEngineLib4Turkey/citys.json'));
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
    function getLanguage($langId){
        return($this->getJson2val('inc/evoEngineLib4Turkey/language.json',$langId));
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

        foreach ($jsonArray[$semtCode]['mah'] as $key => $value){
            $finishArray[$value['id']] = $value['name'];
        }

        return($finishArray[$mahCode]);
    }

    private function cityTaxAdminJson($city){

        $jsonArray = array();

        if($city >= 61){
            $jsonFile = 'inc/evoEngineLib4Turkey/cityTaxAdminPart4.json';
        }elseif($city >= 41 AND $city <= 60){
            $jsonFile = 'inc/evoEngineLib4Turkey/cityTaxAdminPart3.json';
        }elseif($city >= 21 AND $city <= 40){
            $jsonFile = 'inc/evoEngineLib4Turkey/cityTaxAdminPart2.json';
        }elseif($city >= 1 AND $city <= 20){
            $jsonFile = 'inc/evoEngineLib4Turkey/cityTaxAdminPart1.json';
        }else{
            $jsonFile = null;
        }

        if($jsonFile!=null){
            $jsonFile = @file_get_contents($jsonFile);
            $jsonArray = json_decode($jsonFile,true);
            $jsonArray = $jsonArray[$city];
        }

        return($jsonArray);
    }

    function getCityTaxAdminsArray($city){

        $jsonArray = $this->cityTaxAdminJson($city);
        $taxOffice = array();
        foreach ($jsonArray as $key => $value){
            $taxOffice[$key] = ($value['name']);
        }
        return($taxOffice);
    }
    function getCityTaxAdminName($city,$taxAdmin){
        $jsonArray = $this->cityTaxAdminJson($city);
        return($jsonArray[$taxAdmin]['name']);
    }

    function getUniversity($id){
        return($this->getJson2val('inc/evoEngineLib4Turkey/university.json',$id));
    }

    function getUniversityArray(){
        return($this->getJson2DArray('inc/evoEngineLib4Turkey/university.json'));
    }

    function getLanguageArray($type = 2){

        if($type==2){
            $return = $this->getJson2DArray('inc/evoEngineLib4Turkey/language.json');
        }else{
            $return = $this->getJsonArray('inc/evoEngineLib4Turkey/language.json');
        }

        return($return);
    }

    public function checkNationalityId($numberOfTC){
        $return = false;

        //onbir haneyse ve rakam ise isleme devam et
        if ( strlen($numberOfTC) == 11 AND is_numeric($numberOfTC) == true){

            $numberOfTCArray = str_split($numberOfTC);  //basamaklarına ayır

            $testOf10 = fmod( ( $numberOfTCArray[0] + $numberOfTCArray[2] + $numberOfTCArray[4] + $numberOfTCArray[6] + $numberOfTCArray[8] ) * 7  - ( $numberOfTCArray[1] + $numberOfTCArray[3] + $numberOfTCArray[5] + $numberOfTCArray[7] )     ,10) ;
            $testOf11 = fmod( $numberOfTCArray[0] + $numberOfTCArray[1] + $numberOfTCArray[2] + $numberOfTCArray[3] + $numberOfTCArray[4] + $numberOfTCArray[5] + $numberOfTCArray[6] + $numberOfTCArray[7] + $numberOfTCArray[8] + $numberOfTCArray[9]     ,10);

            //Birinci basamak sıfır olamaz
            // T.C. Kimlik Numaralarımızın 1. 3. 5. 7. ve 9. hanelerinin toplamının 7 katından, 2. 4. 6. ve 8. hanelerinin toplamı çıkartıldığında, elde edilen sonucun 10'a bölümünden kalan, yani Mod10'u bize 10. haneyi verir.
            // 1. 2. 3. 4. 5. 6. 7. 8. 9. ve 10. hanelerin toplamından elde edilen sonucun 10'a bölümünden kalan, yani Mod10'u bize 11. haneyi verir.

            if($numberOfTCArray[0] != 0 AND $testOf10 == $numberOfTCArray[9] AND $testOf11 == $numberOfTCArray[10]){
                $return=true;
            }
        }

        return($return);
    }

    public function checkTaxNumber($numberOfTax){
        $return = false;

        //on hane ve rakam ise isleme devam et
        if ( strlen($numberOfTax) == 10 AND is_numeric($numberOfTax) == true){

            $numberOfTaxArray = str_split($numberOfTax);  //basamaklarına ayır
            $total = 0; $operation = array();

            for($i= 0; $i <= 8; $i++){
                $numberCache = $i+1;
                //Vergi numarasının ilk 9 rakamına sırayla 10 eklenip sıra değeri (en büyük basamak değeri 1 ve en küçük basamak değeri 9 kabul edilir) çıkarılır, çıkan sonucun modül 10'a göre değeri alınır.
                $operation[$i] = fmod( ($numberOfTaxArray[$i] + 10 -($numberCache) ), 10 );

                //Elde edilen değer 9 ise bir işlem yapmadan bırakılır. 9 dan farklı bir rakam elde edildi ise değer 2'nin 10 eksi sıra değeri kuvveti ile çarpılıp, modül 9 a göre değeri ele alınır.
                if($operation[$i] == 9){
                    $total = $total + $operation[$i];
                }else{
                    $total = $total + fmod($operation[$i] * (2**(10 - ($numberCache)) ),9);
                }
            }

            //Elde ettiğimiz rakam 10 dan çıkarılır ve tekrar modül 10'a göre değeri vergi numaramızın 10. rakamımızı verir.
            $total = fmod(( 10 - fmod($total,10) ),10);

            if($numberOfTaxArray[9] == $total){
                $return=true;
            }
        }
        return($return);
    }

    public function checkTaxOrTC($numberOfTaxOrTC){
        $status['status'] = false;
        if(strlen($numberOfTaxOrTC) == 10 AND $this->checkTaxNumber($numberOfTaxOrTC)){
            $status['status']   = true;
            $status['text']     ='taxNumber';
        }
        if(strlen($numberOfTaxOrTC) == 11 AND $this->checkNationalityId($numberOfTaxOrTC)){
            $status['text']     ='TCNumber';
            $status['status']   = true;
        }
        return($status);
    }

    function version(){
        return ("evoEngine Library For Turkey Versiyon : ".$this->versionNo());
    }

    public function versionNo(){
        return (1.18);
    }
}