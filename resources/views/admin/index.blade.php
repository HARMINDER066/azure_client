@extends('admin.app')
@section('content')
                  <div class="pcoded-content">
                     <div class="pcoded-inner-content">
                        <div class="main-body">
                           <div class="page-wrapper">
                              <div class="page-body">
                                 <div class="row">
                                     <div class="col-xl-3 col-md-6">
                                       <div class="card bg-c-yellow update-card">
                                          <div class="card-block">
                                             <div class="row align-items-end">
                                                <div class="col-8">
                                                   <h4 class="text-white">{{$data['all']}}</h4>
                                                   <h6 class="text-white m-b-0" style="font-size: 12px;">Total Subscriber</h6>
                                                </div>
                                                <div class="col-4 text-right">
                                                   <canvas id="update-chart-1" height="50"></canvas>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-footer">
                                             <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update
                                                : {{ date('Y-m-d') }}
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                       <div class="card bg-c-green update-card">
                                          <div class="card-block">
                                             <div class="row align-items-end">
                                                <div class="col-8">
                                                   <h4 class="text-white">{{$data['active']}}</h4>
                                                   <h6 class="text-white m-b-0" style="font-size: 12px;">Active Subscriber</h6>
                                                </div>
                                                <div class="col-4 text-right">
                                                   <canvas id="update-chart-2" height="50"></canvas>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-footer">
                                             <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update
                                                : {{ date('Y-m-d') }}
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                       <div class="card bg-c-pink update-card">
                                          <div class="card-block">
                                             <div class="row align-items-end">
                                                <div class="col-8">
                                                   <h4 class="text-white">{{$data['inactive']}}</h4>
                                                   <h6 class="text-white m-b-0" style="font-size: 12px;">InActive Subscriber</h6>
                                                </div>
                                                <div class="col-4 text-right">
                                                   <canvas id="update-chart-3" height="50"></canvas>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-footer">
                                             <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update
                                                : {{ date('Y-m-d') }}
                                             </p>
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
           