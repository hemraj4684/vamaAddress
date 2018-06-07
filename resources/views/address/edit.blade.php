@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Address</div>
				<div class="panel-body">
					@if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{session()->get('message')}}
            </div>
          @endif
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{route('address.update',$recId->id)}}">
						<input type="hidden" name="_method" value="PUT">
	 				  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="{{ $recId->title or old('title') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="number" value="{{ $recId->number or old('number') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address Line1</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addressline1" value="{{ $recId->addressline1 or old('addressline1') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address Line2</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addressline2" value="{{ $recId->addressline2 or old('addressline2') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="addressline3" class="col-md-4 control-label">Address Line3</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addressline3" value="{{ $recId->addressline3 or  old('addressline3') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="pincode" class="col-md-4 control-label">Pin Code</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="pincode" value="{{ $recId->pincode or old('pincode') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="city" class="col-md-4 control-label">City</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="city" value="{{ $recId->city or old('city') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="state" class="col-md-4 control-label">State</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="state" value="{{ $recId->state or old('state') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="country" class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="country" value="{{ $recId->country or old('country') }}">
							</div>
						</div>

						<div class="form-group {{ $errors->has('address_cat') ? ' has-error' : '' }}">
              <label for="address_cat" class="col-md-4 control-label">Address Category</label>
               <div class="input-group col-md-8">
                  <input type="checkbox" name="address_cat" value="f" @if($recId->address_cat === 'f') checked @endif/> Default From&nbsp;&nbsp;
									<input type="checkbox" name="address_cat" value="t" @if($recId->address_cat === 't') checked @endif/> Default To
                  @if ($errors->has('countryId'))
                      <span class="help-block">
                          <strong>{{ $errors->first('country') }}</strong>
                      </span>
                  @endif
              </div>

          	</div>


						<div class="form-group">
							<div class="col-md-offset-1 col-md-6 ">
								<button type="submit" class="btn btn-primary">
									Save
								</button>
							</div>
							<div class="col-md-2 col-md-offset-2">
								<a href="{{route('address.index')}}" class="btn btn-primary">
									View
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
