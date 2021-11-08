<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class BikeUser extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Contact' => 'Int',
        'Notes' => 'Varchar'
    ];

    private static $has_one = [
        'BikeUserPage' => BikeUserPage::class
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Name', 'Name'),
            TextField::create('Contact', 'Contact No'),
            TextareaField::create('Notes', 'Any Description')
        );
        return $fields;
    }
}
