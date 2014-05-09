<?php

namespace UPS\Entity;


class Package {
    const PKG_OVERSIZE1 = '1';
    const PKG_OVERSIZE2 = '2';
    const PKG_LARGE = '4';

    public $PackagingType;
    public $PackageWeight;
    public $Description;
    public $PackageServiceOptions;
    public $UPSPremiumCareIndicator;
    public $ReferenceNumber;
    public $TrackingNumber;
    public $LargePackage;
    public $Dimensions;
    public $Activity;

    function __construct( $response = null ) {
        $this->ReferenceNumber = new ReferenceNumber();
        $this->Dimensions = new Dimensions();
        $this->Activity = new Activity();

        if ( null != $response ) {
            if ( isset( $response->PackageWeight ) ) {
                $this->PackageWeight = new PackageWeight($response->PackageWeight);
            }
            if ( isset( $response->Description ) ) {
                $this->Description = $response->Description;
            }
            if ( isset( $response->PackageServiceOptions ) ) {
                $this->PackageServiceOptions = new PackageServiceOptions($response->PackageServiceOptions);
            }
            if ( isset( $response->UPSPremiumCareIndicator ) ) {
                $this->UPSPremiumCareIndicator = $response->UPSPremiumCareIndicator;
            }
            if ( isset( $response->ReferenceNumber ) ) {
                $this->ReferenceNumber = new ReferenceNumber($response->ReferenceNumber);
            }
            if ( isset( $response->TrackingNumber ) ) {
                $this->TrackingNumber = $response->TrackingNumber;
            }
            if ( isset( $response->LargePackage ) ) {
                $this->LargePackage = $response->LargePackage;
            }
            if ( isset( $response->Dimensions ) ) {
                $this->Dimensions = new Dimensions($response->Dimensions);
            }
            if ( isset( $response->Activity ) ) {
                if ( is_array( $response->Activity )) {
                    foreach( $response->Activity as $Activity) {
                        $this->Activity[] = new Activity( $Activity );
                    }
                }
                else {
                    $this->Activity[] = new Activity( $response->Activity );
                }
            }
        }
    }
}