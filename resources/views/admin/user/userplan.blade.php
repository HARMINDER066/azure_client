@extends('admin.app')

@section('content')
<div class="pcoded-content"> 
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">   
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-lg-8">
      <div class="page-header-title">
        <div class="d-inline">
          <h4>User Plan Upgrade/DownGrade</h4>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>           
<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-block">
          <h4 class="sub-title">User Details</h4>
        <div class="col-lg-12 col-xl-12">
             <div class="card">
        <div class="card-block">
              <form method="post" class="col-md-8" action="{{ route('user.updateSubscriptionStore', ['id' => $userdetail->id]) }}">
                @csrf
    <div class="form-group row">
        <span class="label-text col-md-3 col-form-label">Name</span>

        <div class="col-md-9">
        {{$userdetail->name}}
    </div>
    </div>
      <div class="form-group row">
        <span class="label-text col-md-3 col-form-label">Email</span>

        <div class="col-md-9">
      {{$userdetail->email}} 
    </div>
    </div>
           <div class="form-group row">
        <span class="label-text col-md-3 col-form-label">Facebook Id</span>

        <div class="col-md-9">
          @if(count($userdetail->account))
      {{$userdetail->account[0]->fb_account_id }} 
      @endif
     </div>
    </div>
  
  <div class="form-group row">
        <span class="label-text col-md-3 col-form-label">Current Plan</span>

        <div class="col-md-9">
      {{$userdetail->plan->name}} 
    </div>
    </div>
    <div class="form-group row">
        <span class="label-text col-md-3 col-form-label">Renew Date</span>

        <div class="col-md-9">
     {{ $userdetail->expired_on}}
    </div>
    </div>
                    
  <div class="form-group row">
        <span class="label-text col-md-3 col-form-label">Select Plan*</span>
   <div class="col-md-9">
      <select class="form-control" name="plan_id">
         @foreach($plans as $plan)
          <option value="{{$plan->id}}" {{ ($plan->id == $userdetail->plan_id) ? "selected" : "" }}>
          {{$plan->name}} - {{$plan->plan_type}} (${{$plan->amount}})
          </option>
          @endforeach 
      </select>
        </div>
    </div>                  
    <div class="row mt-3">
        <div class="col-md-9 offset-md-3">
            <input type="submit" value="Update" class="btn btn-rounded btn-success">
        </div>
    </div>
</form>

                </div>
            </div>
          </div>
        </div>
      </div>
   </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
 @endsection
           