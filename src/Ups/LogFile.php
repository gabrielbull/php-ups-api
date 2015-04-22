<?php
namespace Ups;

use Exception;
use DateTime;

class LogFile implements LogInterface
{

    /**
     * @var string
     */
    protected $folder;

    /**
     * @object DateTime
     */
    private $requestTime;

    /**
     * @param $folder
     * @throws Exception
     */
    public function __construct($folder)
    {
        if(!is_dir($folder)) {
            throw new Exception('Folder ' . $folder . ' does not exist');
        }
        $this->folder = $folder;
    }

    /**
     * Log requests to XML file
     *
     * @param $content
     * @param $endpointurl
     * @return int
     */
    public function request($content, $endpointurl)
    {
        $this->requestTime = new DateTime();
        $this->setFileBase($endpointurl);
        return file_put_contents($this->fileBase . '-request.xml', $content);
    }

    /**
     * Log response to XML file
     *
     * @param $content
     * @param $endpointurl
     * @return int
     */
    public function response($content, $endpointurl)
    {
        return file_put_contents($this->fileBase . '-response.xml', $content);
    }

    /**
     * Set base file based on endpointurl
     *
     * @param $endpointurl
     */
    private function setFileBase($endpointurl)
    {
        $this->fileBase = $this->folder . '/' . $this->requestTime->format('YmdHisu') . '-' . substr($endpointurl, strrpos($endpointurl, '/') + 1);
    }

}