<?php
namespace Ups;

use SimpleXMLElement;
use Exception;

class Request implements RequestInterface
{
    /**
     * Send request to UPS
     *
     * @param string $access The access request xml
     * @param string $request The request xml
     * @param string $endpointurl The UPS API Endpoint URL
     * @return Response
     * @throws Exception
     */
    public function request($access, $request, $endpointurl)
    {
        // Create POST request
        $form = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $access . $request
            )
        );

        $request = stream_context_create($form);

        if (!$handle = fopen($endpointurl, 'rb', false, $request)) {
            throw new Exception("Failure: Connection to Endpoint URL failed.");
        }

        $response = stream_get_contents($handle);
        fclose($handle);

        if ($response != false) {
            $response = new SimpleXMLElement($response);
            if (isset($response->Response) && isset($response->Response->ResponseStatusCode)) {
                return (new Response)->setResponse($response);
            }
        }

        throw new Exception("Failure: Response is invalid.");
    }
}