@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                        All Address
                        <a href="{{ route('address.create') }}" class="btn btn-primary pull-right">Create</a>

                     <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('message')}}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('error')}}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-responsive table-striped table-bordered table-hover no-margin">
                          <thead>
                            <tr>
                             <th>Serial No.</th>
                             <th>Title</th>
                             <th>Number</th>
                             <th>Address Line1</th>
                             <th>Address Line2</th>
                             <th>Address Line3</th>
                             <th>country</th>
                             <th>City</th>
                             <th>Pin code</th>
                             <th>Address Category</th>
                             <th colspan="2" style="width:10%; text-align: center">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                         <?php $i=1; ?>
                         @foreach(\App\Address::paginate(10) as $address)
                           <tr>
                             <td>{{$i++}}</td>
                             <td>{{$address->title}}</td>
                             <td>{{$address->number}}</td>
                             <td>{{$address->addressline1}}</td>
                             <td>{{$address->addressline2}}</td>
                             <td>{{$address->addressline3}}</td>
                             <td>{{$address->country}}</td>
                             <td>{{$address->city}}</td>
                             <td>{{$address->pincode}}</td>
                             <td>
                               @if($address->address_cat === 'f')
                                Default From
                               @elseif($address->address_cat === 't')
                                Default To
                               @endif
                             </td>
                             <td><a href="{{route('address.edit',$address->id)}}" class="btn btn-xs btn-danger">Edit</a></td>
                             <td>
                              <form action="{{route('address.destroy',$address->id)}}" method="post" id="confirm">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="submit" value="Del" class="btn btn-xs btn-danger" type="button">
                              </form>
                             </td>
                           </tr>
                         @endforeach
                         </tbody>
                      </table>
                   </div>
                    {!! \App\Address::paginate(10)->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
