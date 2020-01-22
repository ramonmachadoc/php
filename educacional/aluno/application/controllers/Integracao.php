<?php

/**
 * Description of Integracao
 * @author Karol Oliveira
 */

class Integracao extends CI_Controller {

    function __construct() {
        parent::__construct();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if ($this->session->userdata('admin_loginaluno') != 1)
            redirect(base_url(), 'refresh');
    }

    public function index() {


        $service_url = 'https://digitallibraryv2.zbra.com.br/DigitalLibraryIntegrationService/AuthenticatedUrl';
        $curl = curl_init($service_url);

        $temp = explode(" ", $this->session->userdata('nome')); 
         
        // dados do usuario 
        $firstName = $temp[0]; 
        $lastName = $temp[count($temp) - 1]; 
        $email = intval($this->session->userdata('login')); 
        
        
        $curl_post_data = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
                            <CreateAuthenticatedUrlRequest
                            xmlns=\"http://dli.zbra.com.br\"
                            xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"
                            xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">
                            <FirstName>$firstName</FirstName>
                            <LastName>$lastName</LastName>
                            <Email>$email</Email>
                            <CourseId xsi:nil=\"true\"/>
                            <Tag xsi:nil=\"true\"/>
                            <Isbn xsi:nil=\"true\"/>
                            </CreateAuthenticatedUrlRequest>";
        $content_size = strlen($curl_post_data);


        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/xml; charset=utf-8",
            "Host: digitallibrary-staging.zbra.com.br",
            "Content-Length: $content_size",
            "Expect: 100-continue",
            "Accept-Encoding: gzip, deflate",
            "Connection: Keep-Alive",
            "X-DigitalLibraryIntegration-API-Key: 578c068f-88ad-41d0-a5dd-00ec2fcc8f58")
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            echo curl_error($curl);
            curl_close($curl);
            die();
        }
        curl_close($curl);
        $xml = new SimpleXMLElement($curl_response);
        if ($xml->Success != 'true') {
            die();
        }
        redirect($xml->AuthenticatedUrl, 'refresh');
        die();
    }

}
