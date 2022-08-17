<?php
/**
 * https://stackoverflow.com/questions/34002947/missing-close-tag-soap
 */
namespace Jsanbae\SigadAPI\Utils;
use SoapClient;

class SoapClientPatch extends SoapClient
{

    public function __construct($wsdl, $options)
    {
        parent::__construct($wsdl, $options);
    }

    public function __doRequest($req, $location, $action, $version = "SOAP_1_2", $one_way = 0)
    {
        $response = parent::__doRequest($req, $location, $action, $version, $one_way);
        $response = preg_replace('/^(\x00\x00\xFE\xFF|\xFF\xFE\x00\x00|\xFE\xFF|\xFF\xFE|\xEF\xBB\xBF)/', "", $response);
        $response = mb_convert_encoding($response, "UTF-8", 'HTML-ENTITIES');
        
        return $response;
    }
}
