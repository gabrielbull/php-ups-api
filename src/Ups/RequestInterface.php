<?php
namespace Ups;

interface RequestInterface
{
    /**
     * @param string $access The access request xml
     * @param string $request The request xml
     * @param string $endpointurl The UPS API Endpoint URL
     * @return ResponseInterface
     */
    public function request($access, $request, $endpointurl);

    /**
     * @param $access
     */
    public function setAccess($access);

    /**
     * @return string
     */
    public function getAccess();

    /**
     * @param $request
     */
    public function setRequest($request);

    /**
     * @return string
     */
    public function getRequest();

    /**
     * @param $endpointUrl
     */
    public function setEndpointUrl($endpointUrl);

    /**
     * @return string
     */
    public function getEndpointUrl();
}