<?php

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class BikeUserPage extends Page
{
  private static $has_many =[
      'BikeUsers' => BikeUser::class
  ];

  private static $owns =[
      'BikeUsers'
  ];

  public function getCMSFields()
  {
      $fields = parent::getCMSFields();
      $fields->addFieldToTab('Root.Bike Users', GridField::create(
          'BikeUsers',
          'Bike user list on this page',
          $this->BikeUsers(),
          GridFieldConfig_RecordEditor::create()
      ));
      return $fields;
  }


}
