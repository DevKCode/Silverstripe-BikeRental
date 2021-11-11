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

    public function prepareBikeList($id = null)
    {
        $bikeList = [];
        if (is_null($id)) {
            $bikes = Bike::get();
        } else {
            $bikes = Bike::get()->filter([
                'ID' => $id]);
        }
        if (!$bikes) {
            return $this->getResponse()->isError(true);
        }
        foreach ($bikes as $bike) {
            $bikeList[$bike->ID] = [
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
        // request param
        $requestParams = $request->allParams();
        $bikeList = $this->prepareBikeList();
        // ajax request
        if ($request->isAjax()) {

            $bikeRental = $this->getBikeRental($requestParams['ID']);
            $bikesWithAvailQty = $this->prepareBikeDate($bikeList, $bikeRental);
            $bikes = ArrayList::create($bikesWithAvailQty);
            return $this->customise([
                'getBikes' => $bikes])->renderWith('../themes/simple/templates/Includes/BikeListView.ss');


        } else {
            $bikeList = json_encode($bikeList);
            $this->getResponse()->setBody($bikeList);
            $this->getResponse()->addHeader("Content-type", "application/json");
            $this->getResponse()->addHeader("Access-Control-Allow-Methods", "GET");
        }
        return $this->getResponse();

    }

    public function getBikeRental($date)
    {
        return BikeRental::get()
            ->filter([
                'bookedDate' => $date
            ]);
    }

    /**
     * Function that prepare available bike qity
     */
    public function prepareBikeDate($bikes = [], $bikeRental)
    {
        $bookedBikesList = [];
        $bikesWithAvailableQty = [];
        foreach ($bikeRental as $rental) {
            if (array_key_exists($rental->BikeID, $bookedBikesList)) {
                $bookedBikesList[$rental->BikeID] = $bookedBikesList[$rental->BikeID] + 1;
            } else {
                $bookedBikesList[$rental->BikeID] = 1;
            }
        }

        foreach ($bikes as $bike) {
            //  $bike[$bookedBikesList[$bike['id']]]['qty'] = $bookedBikesList[$bike['id']] -  $bike['qty'];
            if (!empty($bookedBikesList[$bike['id']])) {
                $bike['qty'] = $bike['qty'] - $bookedBikesList[$bike['id']];
            }
            $bikesWithAvailableQty[] = $bike;
        }
      return $bikesWithAvailableQty;
    }
}
