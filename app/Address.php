<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator, Schema, Auth;

class Address extends Model {

	  protected $table = 'defualt_address';

    public $columns = [];

    protected $rules = [
      'title'         => 'required|min:2|max:255',
      'addressline1'  => 'required',
      'addressline2'  => 'required',
      'addressline3'  => 'required',
      'addressline3'  => 'required',
      'address_cat'   => 'required',
      'pincode'       => 'required|numeric',
    ];



    public function validateAddress(array $data)
    {
    	return  Validator::make($data, $this->rules);
    }

    public function saveAddress(array $data, $id=null)
    {
    	//get all columns of current model

    	$columns = Schema::getColumnListing($this->table);

/****** automate save process getting all column names and text box name and save textbox value in columns ******/

    	foreach ($data as $key => $value) {
    		if(in_array($key, $columns)){
    			$this->$key = $value;
    		}
    	}

      if(isset(Auth::user()->id))
        $this->user_id = Auth::user()->id;

    	return $this->save();
    }

    public function updateAddress(array $data, $id)
    {
    	//get all columns of current model

    	$columns = Schema::getColumnListing($this->table);

/****** automate save process getting all column names and text box name and save textbox value in columns ******/
    	$obj = $this->find($id);
    	//dd($obj);
    	foreach ($data as $key => $value) {
    		if(in_array($key, $columns)){
    			$obj->$key = $value;
    		}
    	}

    	return $obj->save();
    }

}
