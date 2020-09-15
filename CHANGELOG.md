# CHANGELOG

## 1.2.0 (released 15-09-2020)

- Removed PHP 5.5, 5.6 and 7.0 support
- Add Guzzle 7 support (thanks @neoteknic #289)
- Add support of PHP 8.0
- Update PHPUnit to version 7 or 9.3

## 0.7.12 (released 19-03-2016)

- Extend ShipmentServiceOptions in Shipping API
- Fix for Begin and End date in Tracking API
- Support for HazMat containers in Shipping API 

## 0.7.11 (released 15-09-2016)

- Multiple results in Tracking + add Simple Address Validation class

## 0.7.10 (released 12-07-2016) 

- Solve an issue when mb_detect_encoding couldn't detect it, use a fallback to use utf8_encode. Else response parsing breaks.

## 0.7.9 (released 01-07-2016)

- Add Shipping API Support for AdditionalDocumentIndicator in the InternationalForms node
- Add Shipping API Support for EEIFilingOption in the InternationalForms node
- Add TimeInTransit API Response Service Code Constants for US/EU Shipments to Entity/Service.php
- Add Tracking API Response StatusType Constants

## 0.7.8 (released 23-06-2016)

- Do not create new Guzzle object instance on each Request, but re-use it. 

## 0.7.7 (released 31-05-2016)

- Added AccessPointCOD under ShipmentServiceOptions
- RatedShipment extended with extra fields
- Password field (under Access tag) support entities now

## 0.7.6 (released 04-03-2016)

- Add extra parameters for filtering on Tracking API

## 0.7.5 (released 01-03-2016)

- Improved Address Validation returned object

## 0.7.4 (released 21-02-2016)

- Bugfix: switched node names in XAV

## 0.7.3 (released 17-02-2016)

- Mail Innovation support in Tracking    
- Option to get a result object from the Validation class with several methods to make you process the results easier. Does not introduce backwords incompatibility, as it's an optional feature.

## 0.7.2 (released 09-01-2016)

- Bugfix: Use SoapRequest instead of Request in Tradeability

## 0.7.1 (released 23-11-2015)

- Adds support for a second reference number

## 0.7.0 (released 16-11-2015)

- **[!]** Default ShipFrom on Shipment class not set anymore in constructor (ShipFrom is optional)
- Adds support for cash on delivery for shipments

Items marked with **[!]**  may incur backwards incompatibility.

## 0.6.3 (released 10-11-2015)

- Improvement in parsing XML

## 0.6.2 (released 10-11-2015)

- Add Landed Cost request of Tradeability API (using SOAP). Tradeability consist of 4 endpoints, of which now one is implemented.

## 0.6.1 (released 30-10-2015)

- Add option to use the Tracking API also when supplying a ReferenceNumber

## 0.6.0 (released 25-09-2015)

- Extra check on response in QuantumView, when no response it gave an error
- Added ShipmentRequestLabelSpecification class for easier options setting
- Added ShipmentRequestReceiptSpecification class for easier options setting
- **[!]** Shipment class dropped some public properties in favor of private properties and setter/getter methods.
- **[!]** `confirm` and `accept` methods of Shipping class now receive Shipment, ShipmentRequestLabelSpecification and
ShipmentRequestReceiptSpecification

Items marked with **[!]**  may and will incur backwards incompatibility.

## 0.5.2 (released 16-09-2015)

- TimeInTransit ServiceSummary results should be array of summaries, which was not the case when 1 result

## 0.5.1 (released 08-09-2015)

- Limit alternate delivery address names to 35 characters

## 0.5.0 (released 26-08-2015)

- Added UTF8 compatibility for UPS responses
- Added Guzzle to handle requests
- Changed required PHP version to 5.5
- Removed Autoloader in favor of composer
