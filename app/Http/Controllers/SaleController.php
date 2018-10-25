<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Customer;
use App\Sale;

class SaleController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index($startDate)
  {
    error_log($startDate);
    $sales = Sale::with('customer', 'customer.business', 'customer.office', 'customer.job')->get();
    return ['sales' => $sales];
  }

  public function betweenDates($startDate, $endDate, $business_id = null)
  {
    if($business_id) {
      $sales = Sale::whereHas('customer', function($query) use ($business_id) {
        $query->where('business_id', $business_id);
      })->with('customer', 'customer.business', 'customer.office', 'customer.job')
        ->whereBetween('created_at', [date($startDate), date($endDate)])->get();
    } else {
      $sales = Sale::whereBetween('created_at', [date($startDate), date($endDate)])
        ->with('customer', 'customer.business', 'customer.office', 'customer.job')->get();
    }
    return ['sales' => $sales];
  }

  public function salesExcel($startDate, $endDate, $business_id = null)
  {
    if($business_id) {
      $sales = Sale::whereHas('customer', function($query) use ($business_id) {
        $query->where('business_id', $business_id);
      })->with('customer', 'customer.business', 'customer.office', 'customer.job')
        ->whereBetween('created_at', [date($startDate), date($endDate)])->get();
      $businesses = Business::with('offices', 'jobs')->get();
    } else {
      $sales = Sale::whereBetween('created_at', [date($startDate), date($endDate)])
        ->with('customer', 'customer.business', 'customer.office', 'customer.job')->get();
      $businesses = Business::with('offices', 'jobs')->get();
    }
    // return ['sales' => $sales];
    return view('print/salesExcel', [
      'startDate' => $startDate,
      'endDate' => $endDate,
      'sales' => $sales,
      'businesses' => $businesses
    ]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $customers = Customer::all();
    return view('sale.create', ['customers' => $customers]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // return "<pre>".json_encode($request->all(), JSON_PRETTY_PRINT)."</pre>";
    foreach ($request->sales as $key => $item) {
      $sale = new Sale($item);
      $sale->save();
    }
    return ['ok' => true];
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
