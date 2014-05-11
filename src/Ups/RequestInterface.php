<?php
namespace Ups;

interface RequestInterface
{
    public function request($access, $request, $endpointurl);
}