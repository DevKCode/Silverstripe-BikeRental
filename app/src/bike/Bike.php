<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Bike extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Brand' => 'Varchar',
        'Year' => 'Int',
        'Qty' => 'Int',
        'PerHourCharge' => 'Currency'
    ];

    private static $has_one = [
        'BikePage' => BikePage::class
    ];

    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('Name'),
            TextField::create('Brand'),
            TextField::create('Year'),
            TextField::create('Qty'),
            TextField::create('PerHourCharge')
        );
   }
}
