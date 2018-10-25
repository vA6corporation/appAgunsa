<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Office;
use App\Job;

class BusinessController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $businesses = Business::with('offices', 'jobs')->get();
    return ['businesses' => $businesses];
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('business.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $business = new Business($request->business);
    $business->save();
    foreach ($request->business['offices'] as $key => $item) {
      $office = new Office([
        'business_id' => $business->id,
        'name' => $item['name'],
      ]);
      $office->save();
    }
    foreach ($request->business['jobs'] as $key => $item) {
      $job = new Job([
        'business_id' => $business->id,
        'name' => $item['name'],
      ]);
      $job->save();
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
    $business = Business::with('offices', 'jobs')->find($id);
    return ['business' => $business];
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $customerBusiness = CustomerBusiness::where('id', $id)->first();
    $offices = BusinessOffice::where('business_id', $customerBusiness->id)->get();
    return view('customerBusiness.edit', [
      'customerBusiness' => $customerBusiness,
      'offices' => $offices,
    ]);
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
    $customerBusiness = CustomerBusiness::where('id', $id)->first();
    $customerBusiness->fill($request->all());
    $customerBusiness->save();
    // BusinessOffice::where('business_id', $customerBusiness->id)->delete();
    // foreach ($request->offices as $key => $item) {
    //   $businessOffice = new BusinessOffice([
    //     'business_id' => $customerBusiness->id,
    //     'name' => $item,
    //   ]);
    //   $businessOffice->save();
    // }
    return redirect()->route('businesses.index');
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
