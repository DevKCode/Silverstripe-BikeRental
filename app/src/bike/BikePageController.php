<?php

use SilverStripe\Control\HTTPRequest as HTTPRequest;
use SilverStripe\Control\HTTPResponse as HTTPResponseAlias;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

class BikePageController extends PageController
{
    private static $allowed_actions = [

        'prepareBikeList',
        'bikes'
    ];

//    public function index(HTTPRequest $request)
//    {
//      //  return $this->getbikes($request);
//    }

    protected function init()
    {
        parent::init(); //
        Requirements::javascript("https://code.jquery.com/jquery-3.6.0.min.js");
        Requirements::javascript('themes/simple/javascript/process.js');
    }

    public function prepareBikeList(HTTPRequest $request)
    {

        $params = $request->allParams();
        $bikeList = [];
        if (is_null($params['ID'])) {
            $bikes = Bike::get();
        } else {
            $bikes = Bike::get()->filter([
                'ID' => $params['ID']
            ]);
        }
        if (!$bikes) {
            return $this->getResponse()->isError(true);
        }
        foreach ($bikes as $bike) {
            $bikeList[] = [
                'id' => $bike->ID,
                'name' => $bike->Name,
                'brand' => $bike->Brand,
                'Year' => $bike->Year,
                'qty' => $bike->Qty,
                'hourCharge' => $bike->PerHourCharge
            ];
        }
        return $bikeList;


    }

    public function bikes(HTTPRequest $request)
    {
        $bikeList = $this->prepareBikeList($request);
        // ajax request
        if ($request->isAjax()) {
            $bikeData = ArrayList::create($bikeList);
            return $this->customise([
                'getBikes' => $bikeData])->renderWith('../themes/simple/templates/Includes/BikeListView.ss');


        } else {
            $bikeList = json_encode($bikeList);
            $this->getResponse()->setBody($bikeList);
            $this->getResponse()->addHeader("Content-type", "application/json");
            $this->getResponse()->addHeader("Access-Control-Allow-Methods", "GET");
        }
        return $this->getResponse();

    }

    public function prepareAvailableBikes($date)
    {
        return BikeRental::get()->filter([
            'bookedDate' => $date
        ]);
    }
}
