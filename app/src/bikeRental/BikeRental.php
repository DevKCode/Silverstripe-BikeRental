<?php

use SilverStripe\ORM\DataObject;

class BikeRental extends DataObject
{
    private static $db = [
        'bookedDate' => 'Date'
        ];

    private static $has_one = [
        'BikeUser' => BikeUser::class,
        'Bike' => Bike::class,
        'BikeRental' =>  BikeRentalPage::class
    ];


}


