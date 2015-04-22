<?php
namespace Ups;

interface LogInterface
{

    /**
     * @param $content
     * @param $endpointurl
     * @return mixed
     */
    public function request($content, $endpointurl);

    /**
     * @param $content
     * @param $endpointurl
     * @return mixed
     */
    public function response($content, $endpointurl);


}