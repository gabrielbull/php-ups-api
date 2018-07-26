<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class LabelDelivery implements NodeInterface
{
    /**
     * @var boolean
     */
    public $LabelLinkIndicator;

    /**
     * @var string
     */
    public $EMailAddress;

    /**
     * @var string
     */
    public $UndeliverableEMailAddress;

    /**
     * @var string
     */
    public $FromEMailAddress;

    /**
     * @var string
     */
    public $FromName;

    /**
     * @var string
     */
    public $Subject;

    /**
     * @var string
     */
    public $Memo;

    /**
     * @var string
     */
    public $SubjectCode;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->LabelLinkIndicator = null;

        if (null !== $response) {
            if (isset($response->LabelLinkIndicator)) {
                $this->LabelLinkIndicator = true;
            }

            if (isset($response->EMailAddress)) {
                $this->setEmailAddress($response->EMailAddress);
            }

            if (isset($response->UndeliverableEMailAddress)) {
                $this->setUndeliverableEMailAddress($response->UndeliverableEMailAddress);
            }

            if (isset($response->FromEMailAddress)) {
                $this->setFromEMailAddress($response->FromEMailAddress);
            }

            if (isset($response->FromName)) {
                $this->setFromName($response->FromName);
            }

            if (isset($response->Subject)) {
                $this->setSubject($response->Subject);
            }

            if (isset($response->Memo)) {
                $this->setMemo($response->Memo);
            }

            if (isset($response->SubjectCode)) {
                $this->setSubjectCode($response->SubjectCode);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('LabelDelivery');

        if (isset($this->LabelLinkIndicator)) {
            $node->appendChild($document->createElement('LabelLinkIndicator', $this->LabelLinkIndicator));
        }

        if (isset($this->EMailAddress)) {
            $node->appendChild($document->createElement('EMailAddress', $this->EMailAddress));
        }

        if (isset($this->UndeliverableEMailAddress)) {
            $node->appendChild($document->createElement('UndeliverableEMailAddress', $this->UndeliverableEMailAddress));
        }

        if (isset($this->FromEMailAddress)) {
            $node->appendChild($document->createElement('FromEMailAddress', $this->FromEMailAddress));
        }

        if (isset($this->FromName)) {
            $node->appendChild($document->createElement('FromName', $this->FromName));
        }

        if (isset($this->Subject)) {
            $node->appendChild($document->createElement('Subject', $this->Subject));
        }

        if (isset($this->Memo)) {
            $node->appendChild($document->createElement('Memo', $this->Memo));
        }

        if (isset($this->SubjectCode)) {
            $node->appendChild($document->createElement('SubjectCode', $this->SubjectCode));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getLabelLinkIndicator()
    {
        return $this->LabelLinkIndicator;
    }

    /**
     * @return $this
     */
    public function setLabelLinkIndicator($labelLinkIndicator)
    {
        $this->LabelLinkIndicator = $labelLinkIndicator;

        return $this;
    }

    /**
     * @return string
     */
    public function getEMailAddress()
    {
        return $this->EMailAddress;
    }

    /**
     * @return $this
     */
    public function setEMailAddress($eMailAddress)
    {
        $this->EMailAddress = $eMailAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getUndeliverableEMailAddress()
    {
        return $this->UndeliverableEMailAddress;
    }

    /**
     * @return $this
     */
    public function setUndeliverableEMailAddress($undeliverableEMailAddress)
    {
        $this->UndeliverableEMailAddress = $undeliverableEMailAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromEMailAddress()
    {
        return $this->FromEMailAddress;
    }

    /**
     * @return $this
     */
    public function setFromEMailAddress($fromEMailAddress)
    {
        $this->FromEMailAddress = $fromEMailAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->FromName;
    }

    /**
     * @return $this
     */
    public function setFromName($fromName)
    {
        $this->FromName = $fromName;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->Subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getMemo()
    {
        return $this->Memo;
    }

    /**
     * @return $this
     */
    public function setMemo($memo)
    {
        $this->Memo = $memo;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubjectCode()
    {
        return $this->SubjectCode;
    }

    /**
     * @return $this
     */
    public function setSubjectCode($subjectCode)
    {
        $this->SubjectCode = $subjectCode;

        return $this;
    }
}
