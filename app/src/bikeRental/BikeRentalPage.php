<?php

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class BikeRentalPage extends Page
{
     private static $has_many = [
         'BikeRentals' => BikeRental::class
     ];

     public function getCMSFields()
     {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Booking', GridField::create(
            'BikeRentals',
            'Booking on Bikes',
            $this->BikeRentals(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
     }
}
