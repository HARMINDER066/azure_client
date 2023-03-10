@extends('admin.app')
@push('script')
<script type="text/javascript" src="{{asset('backend/files/assets/sweetalert.min.js')}}"></script>

  <script>
              function userstatus(id){
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#67355c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
               $.ajax({
    url: "{{ route('user.fb_account_delete') }}",
    method: "POST",
    data:{
        _token: '{{ csrf_token() }}',
        id: id
    },
    success:function(response){
        if(response == 1)
        {
                        new PNotify({title: 'Success',text: "User Active Successfully",
                        icon: 'icofont icofont-info-circle',type: 'success'
                    });
                        location.reload();
        }
        else
        {
           new PNotify({title: 'Danger',text: "Something Error",
                        icon: 'icofont icofont-info-circle',type: 'error'
                        });
        }
    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
})
            }
        });
              }

      </script>
@endpush
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
          <h4>Edit User</h4>
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

  <ul class="nav nav-tabs md-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home3" role="tab" aria-selected="false">Profile</a>
      <div class="slide"></div>
    </li>
  </ul>
  <div class="tab-content card-block">
    <div class="tab-pane active" id="home3" role="tabpanel">
      <form method="post" class="col-md-8" action="{{ route('user.user_edit_submit', ['id' => $userdetail->id]) }}">
            @csrf
             <div class="form-group row">
              <label class="col-sm-4 col-form-label">Name: *</label>
              <div class="col-sm-8">
                <input type="text" value="{{$userdetail->name}}" name="name" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Email: *</label>
              <div class="col-sm-8">
                <input type="email" value="{{$userdetail->email}}" name="email" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Licence: *</label>
              <div class="col-sm-8">
                <input type="text" value="{{$userdetail->license_key}}" name="license" class="form-control" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label"></label>
              <div class="col-sm-4">
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
</div>
</div>
</div>
 @endsection
           