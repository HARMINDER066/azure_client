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
          <h4>Change Password</h4>
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
          <h4 class="sub-title">Change Password</h4>
          <form method="post" action="{{ route('admin.changepassword') }}">
            @csrf
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">New Password</label>
              <div class="col-sm-10">
                <input type="text"  name="password" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-md-2">
<button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Update</button>
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
 @endsection
           