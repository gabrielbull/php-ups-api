# CHANGELOG

## 0.6.0 (upcoming)
- Added ShipmentRequestLabelSpecification class for easier options setting
- Added ShipmentRequestReceiptSpecification class for easier options setting
- **[!]** Shipment class dropped some public properties in favor of private properties and setter/getter methods.
- **[!]** `confirm` and `accept` methods of Shipping class now receive Shipment, ShipmentRequestLabelSpecification and
ShipmentRequestReceiptSpecification

Items marked with **[!]**  may and will incur backwards incompatibility.

## 0.5.0 (released 26-08-2015)

- Added UTF8 compatibility for UPS responses
- Added Guzzle to handle requests
- Changed required PHP version to 5.5
- Removed Autoloader in favor of composer
