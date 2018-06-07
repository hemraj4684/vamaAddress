<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Address;
use Illuminate\Http\Request;
use Session;

class AddressController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('address.view');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('address.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $req)
	{

			$address = new Address();

    	$res = $address->validateAddress($req->all());

    	if ($res->fails()) {
            return redirect('address/create')
                        ->withErrors($res)
                        ->withInput();
        }
        else{

        	$saveYN = $address->saveAddress($req->all());
        	if($saveYN){
        		Session::flash('message','Record Saved Successfully');
        		return redirect('address/create');
        	}
        	else{
        		Session::flash('error','Record not Saved Successfully');
        		return redirect('address/create');
        	}

        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$recId = Address::findOrFail($id);
    	//dd($recId);
    return view('address.edit',compact('recId'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $req, $id)
	{
			$address = new Address();
    	$res = $address->validateAddress($req->all());

    	if ($res->fails()) {
        return redirect()->route('address.edit',$id)
                      ->withErrors($res)
                      ->withInput();
      }
      else {
      	$saveYN = $address->updateAddress($req->all(), $id);
      	if($saveYN){
      		Session::flash('message','Record Update Successfully');
      		return redirect()->route('address.edit',$id);
      	}
      	else{
      		Session::flash('error','Record not Updated Successfully');
      		return redirect()->route('address.edit',$id);
      	}
      }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$recId = Address::findOrFail($id);
    $recId->delete();
    	if($recId){
      	Session::flash('message','Record deleted Successfully');
        return redirect()->route('address.index');
    	}
    	else{
    		Session::flash('error','Record not deletd Successfully');
    		return redirect()->route('address.index');
    	}
	}

}
