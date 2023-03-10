@extends('admin.app')
@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/files/assets/switch/switch.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/files/assets/switch/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css') }}">
<style>
      div#user_listing_wrapper{
            width: 100%;
      }
</style>
@endpush
@push('script')
<script src="{{ asset('backend/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{asset('backend/files/assets/switch/switchery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/files/assets/sweetalert.min.js')}}"></script>

<script>

$.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
                orderable: false,
                targets: [1]
            }],
       drawCallback: function () {
            load_active_inactive();
        },
       
    });
function load_active_inactive()
    {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.user_status'));
        elems.forEach(function (html) {

            if (html.getAttribute('data-switchery') === null) {
                var switchery = new Switchery(html, {size: 'small'});
            }
        });

        $(".user_status").change(function () {

              var id = $(this).attr("data-value");
            var state = 0;
            if ($(this).prop("checked") == true) {
                state = 1;
               var  msg = "Are you sure You want To Activate This User";
            } else if ($(this).prop("checked") == false) {
                state = 0;
                var  msg = "Are you sure You want To Deactivate This User";
            }

 swal({
            title: msg,
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#67355c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {

              var url = "{!! url('admin/user_status',['id' => '','state'=>'']) !!}" + "/" + id + "/" + state;
            $.ajax({
                url: url
            }).done(function (data) {
                if (data == 1) {
                    if (state == 1) {
                        $('#user_listing').DataTable().draw()
                        new PNotify({title: 'Success',text: "User Active Successfully",
                        icon: 'icofont icofont-info-circle',type: 'success'
                    });
                     
                    } else {
                        $('#user_listing').DataTable().draw()
                        new PNotify({title: 'Success',text: "User InActive Successfully",
                        icon: 'icofont icofont-info-circle',type: 'success'
                    });
                    }
                } else {
                    new PNotify({title: 'Danger',text: "Something Error",
                        icon: 'icofont icofont-info-circle',type: 'error'
                        });
                }
            }); 
            }
            else
            {
                 $('#user_listing').DataTable().draw()
            }
        });

            
        });

  }
var user_listing = $('#user_listing').DataTable({
        "processing": true,
        "language":
                {
                    "processing": "<p>Processing</p>",
                },
        "serverSide": true,
        "dom": 'lftipr',
        "order": [[0, 'desc']],
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
            ]
        },
        "ajax": {
            "url": "{{route('admin.user.user_list')}}",
            "dataType": "json",
            "type": "POST",
             "data": {_token: "{{csrf_token()}}"}

        },
        "columns": [
             
             { "data": 'DT_RowIndex',"bSearchable": false, "sortable": false},
             {"data": "name","bSearchable": true, "sortable": true},
            {"data": "email","bSearchable": true, "sortable": true},
            {"data": "license"},
            {"data": "createdDate"},
            {"data": "status"},
            {"data": "action", "orderable": false, "bSearchable": false},
        ],

    });
      </script>
      <script>
              function deleteuser(id){
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
    url: "{{ route('admin.user.userdelete') }}",
    method: "POST",
    data:{
        _token: '{{ csrf_token() }}',
        id: id
    },
    success:function(response){
        if(response == 1)
        {
         $('#user_listing').DataTable().draw()
        }
        else
        {
            swal ( "Oops" ,  "Something went wrong!" ,  "error" )
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

      <script>
              function userstatus(id, status){
                   event.preventDefault();
        if(status == 0){
               var  msg = "Are you sure You want To Activate This User";
        }  
        else{
                var  msg = "Are you sure You want To Deactivate This User";
        }   
        swal({
            title: msg,
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
    url: "{{ route('user.subscription') }}",
    method: "POST",
    data:{
        _token: '{{ csrf_token() }}',
        id: id,
        status: status
    },
    success:function(response){
        if(response == 1)
        {
                     $('#user_listing').DataTable().draw()
        new PNotify({title: 'Success',text: "User Status Successfully Changed",
                        icon: 'icofont icofont-info-circle',type: 'success'
                        });
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
          <h4>Subscriber List</h4>
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
<table id="user_listing" class="table table-striped table-bordered nowrap table-responsive" style="width:100%">
  <thead>
    <tr>
      <th>Sr</th>
      <th>Name</th>
      <th>Email</th>
      <th>Licence</th>
      <th>Join On</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>
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