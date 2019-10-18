<?php

namespace Ups;

use Exception;
use Psr\Log\LoggerInterface;
use Ups\Entity\PickupRequest;

/**
 * Pickup API Wrapper.
 *
 * @author Greg Punla
 */
class Pickup extends Ups
{

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null $logger PSR3 compatible logger (optional)
     */
    
    public function __construct(
        $accessKey = null,
        $userId = null,
        $password = null,
        $useIntegration = false,
        LoggerInterface $logger = null
    ) {
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * @param PickupRequest $request
     * @return SimpleXmlElement
     * @throws Exception
     */
    public function getPickupRequest(PickupRequest $request)
    {
       $url = 'https://onlinetools.ups.com/rest/Pickup';

       if($this->useIntegration){
          $url = 'https://wwwcie.ups.com/rest/Pickup';
       }

        $response = $this->sendRequest($request, $url);

        return json_decode($response);
    }


    /**
     * @param PickupRequest $request
     * @return SimpleXmlElement
     * @throws Exception
     */
    public function getCancelPickupRequest(PickupRequest $request)
    {
       $url = 'https://onlinetools.ups.com/rest/Pickup';

       if($this->useIntegration){
          $url = 'https://wwwcie.ups.com/rest/Pickup';
       }

        $response = $this->sendCancelRequest($request, $url);

        return json_decode($response);
    }


    /**
     * Creates and sends a request for the given data. Most errors are handled in SoapRequest
     *
     * @param string $request
     * @param string $endpoint
     *
     * @throws Exception
     *
     * @return \stdClass
     */
    private function sendRequest(PickupRequest $request, $endpoint)
    {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,            $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST,           1 );
        // pickupdate format : YYYYMMDD
        $jsonRequest = '{
          "UPSSecurity": {
              "UsernameToken": {
              "Username": "'. $this->userId.'",
              "Password": "'. $this->password.'"
              },
              "ServiceAccessToken": {
              "AccessLicenseNumber": "'.$this->accessKey.'"
              }
          },
          "PickupCreationRequest": {
              "ReferenceNumber" : "'.$request->getReferenceNumber().'",
              "Request": {
                "TransactionReference": {
                "CustomerContext": "'.$request->getTransactionReference().'"
              }
          },
          "RatePickupIndicator": "Y",
          "TaxInformationIndicator": "Y",
              "Shipper": {
                  "Account": {
                  "AccountNumber": "'.$request->getAccountNumber().'",
                  "AccountCountryCode": "'.$request->getAccountCountryCode().'"
                  }
              },
          "PickupDateInfo": {
              "CloseTime": "'.$request->getCloseTime().'",
              "ReadyTime": "'.$request->getReadyTime().'",
              "PickupDate": "'.$request->getPickupDate().'"
          },
          "PickupAddress": {
              "CompanyName": ".'.$request->getCompanyName().'",
              "ContactName": "'.$request->getContactName().'",
              "AddressLine": "'.$request->getAddressLine().'",
              "City": "'.$request->getCity().'",
              "StateProvince": "'.$request->getStateProvince().'",
              "PostalCode": "'.$request->getPostalCode().'",
              "CountryCode": "'.$request->getCountryCode().'",
              "ResidentialIndicator": "N",
              "Phone": {
              "Number": "'.$request->getNumber().'"
              }
          },
          "AlternateAddressIndicator": "N",
          "TotalWeight": {
              "Weight": "'.$request->getPackageTotalWeight().'",
              "UnitOfMeasurement": "'.$request->getUnitOfMeasurement().'"
          },
              "PickupPiece": {
              "ServiceCode": "'.$request->getServiceCode().'",
              "Quantity": "'.$request->getPackageQuantity().'",
              "DestinationCountryCode": "'.$request->getDestinationCountryCode().'",
              "ContainerCode": "01"
              },
          "OverweightIndicator": "Y",
          "PaymentMethod": "'.$request->getPaymentMethod().'",
          "SpecialInstruction": "'.$request->getSpecialInstruction().'" 
          }
      }';

      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));

      $result=curl_exec($ch);
      return $result;
    }

    /**
     * Creates and sends a request for the given data. Most errors are handled in SoapRequest
     *
     * @param string $request
     * @param string $endpoint
     *
     * @throws Exception
     *
     * @return \stdClass
     */
    private function sendCancelRequest(PickupRequest $request, $endpoint)
    {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,            $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST,           1 );
        $jsonRequest = '{
          "UPSSecurity": {
              "UsernameToken": {
              "Username": "'. $this->userId.'",
              "Password": "'. $this->password.'"
              },
              "ServiceAccessToken": {
              "AccessLicenseNumber": "'.$this->accessKey.'"
              }
          },
          "PickupCancelRequest": { 
            "Request": { 
                "TransactionReference": { 
                    "CustomerContext":  "'.$request->getTransactionReference().'" 
                } 
            }, 
            "CancelBy": "'.$request->getCancelType().'", 
            "PRN": "'.$request->getPrnNumber().'" 
            }
        }';

      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));

      $result=curl_exec($ch);
      return $result;
    }

}
