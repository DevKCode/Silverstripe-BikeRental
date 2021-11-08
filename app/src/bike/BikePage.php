<?php

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class BikePage extends  Page
{
    private static $has_many = [
        'Bikes' => Bike::class
    ];

    private static $owns =[
        'Bikes'
    ];

    public function getCMSFields()
    {
       $fields = parent::getCMSFields();
       $fields->addFieldToTab('Root.Bike', GridField::create(
           'Bikes',
           'Bikes info',
           $this->Bikes(),
           GridFieldConfig_RecordEditor::create()
       ));

       return $fields;
    }

    public function getBikes(){
        $bikes = Bike::get();
        return$bikes;
    }
}
