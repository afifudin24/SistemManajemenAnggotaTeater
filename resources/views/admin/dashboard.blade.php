@extends('layouts.dashboard')
@section('content')
       <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Selamat datang, {{ session('user')->admin_name }}</h3>
                   
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
           
              <div class="col-md-12 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Total Admin</p>
                        <p class="fs-30 mb-2">{{$admin}}</p>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Anggota</p>
                        <p class="fs-30 mb-2">{{$anggota}}</p>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Pembina</p>
                        <p class="fs-30 mb-2">{{$pembina}}</p>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Total Bendahara</p>
                        <p class="fs-30 mb-2">{{$bendahara}}</p>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <p class="card-title">Sales Report</p>
                      <a href="#" class="text-info">View all</a>
                    </div>
                    <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                    <div id="sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
                    <canvas id="sales-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                  <div class="card-body">
                    <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <div class="row">
                            <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                              <div class="ml-xl-4 mt-3">
                                <p class="card-title">Detailed Reports</p>
                                <h1 class="text-primary">$34040</h1>
                                <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                                <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                              </div>
                            </div>
                            <div class="col-md-12 col-xl-9">
                              <div class="row">
                                <div class="col-md-6 border-right">
                                  <div class="table-responsive mb-3 mb-md-0 mt-3">
                                    <table class="table table-borderless report-table">
                                      <tr>
                                        <td class="text-muted">Illinois</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">713</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Washington</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">583</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Mississippi</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">924</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">California</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">664</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Maryland</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">560</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Alaska</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">793</h5>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                  <div class="daoughnutchart-wrapper">
                                    <canvas id="north-america-chart"></canvas>
                                  </div>
                                  <div id="north-america-chart-legend">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="row">
                            <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                              <div class="ml-xl-4 mt-3">
                                <p class="card-title">Detailed Reports</p>
                                <h1 class="text-primary">$34040</h1>
                                <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                                <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                              </div>
                            </div>
                            <div class="col-md-12 col-xl-9">
                              <div class="row">
                                <div class="col-md-6 border-right">
                                  <div class="table-responsive mb-3 mb-md-0 mt-3">
                                    <table class="table table-borderless report-table">
                                      <tr>
                                        <td class="text-muted">Illinois</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">713</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Washington</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">583</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Mississippi</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">924</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">California</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">664</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Maryland</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">560</h5>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text-muted">Alaska</td>
                                        <td class="w-100 px-0">
                                          <div class="progress progress-md mx-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <h5 class="font-weight-bold mb-0">793</h5>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                  <div class="daoughnutchart-wrapper">
                                    <canvas id="south-america-chart"></canvas>
                                  </div>
                                  <div id="south-america-chart-legend"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#detailedReports" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      </a>
                      <a class="carousel-control-next" href="#detailedReports" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Search Engine Marketing</td>
                            <td class="font-weight-bold">$362</td>
                            <td>21 Sep 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-success">Completed</div>
                            </td>
                          </tr>
                          <tr>
                            <td>Search Engine Optimization</td>
                            <td class="font-weight-bold">$116</td>
                            <td>13 Jun 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-success">Completed</div>
                            </td>
                          </tr>
                          <tr>
                            <td>Display Advertising</td>
                            <td class="font-weight-bold">$551</td>
                            <td>28 Sep 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-warning">Pending</div>
                            </td>
                          </tr>
                          <tr>
                            <td>Pay Per Click Advertising</td>
                            <td class="font-weight-bold">$523</td>
                            <td>30 Jun 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-warning">Pending</div>
                            </td>
                          </tr>
                          <tr>
                            <td>E-Mail Marketing</td>
                            <td class="font-weight-bold">$781</td>
                            <td>01 Nov 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-danger">Cancelled</div>
                            </td>
                          </tr>
                          <tr>
                            <td>Referral Marketing</td>
                            <td class="font-weight-bold">$283</td>
                            <td>20 Mar 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-warning">Pending</div>
                            </td>
                          </tr>
                          <tr>
                            <td>Social media marketing</td>
                            <td class="font-weight-bold">$897</td>
                            <td>26 Oct 2018</td>
                            <td class="font-weight-medium">
                              <div class="badge badge-success">Completed</div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          {{-- </div> --}}
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Dashboard</h4>
                    <p class="card-description"> Add class <code>.table</code>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Profile</th>
                            <th>VatNo.</th>
                            <th>Created</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Jacob</td>
                            <td>53275531</td>
                            <td>12 May 2017</td>
                            <td><label class="badge badge-danger">Pending</label></td>
                          </tr>
                          <tr>
                            <td>Messsy</td>
                            <td>53275532</td>
                            <td>15 May 2017</td>
                            <td><label class="badge badge-warning">In progress</label></td>
                          </tr>
                          <tr>
                            <td>John</td>
                            <td>53275533</td>
                            <td>14 May 2017</td>
                            <td><label class="badge badge-info">Fixed</label></td>
                          </tr>
                          <tr>
                            <td>Peter</td>
                            <td>53275534</td>
                            <td>16 May 2017</td>
                            <td><label class="badge badge-success">Completed</label></td>
                          </tr>
                          <tr>
                            <td>Dave</td>
                            <td>53275535</td>
                            <td>20 May 2017</td>
                            <td><label class="badge badge-warning">In progress</label></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> User </th>
                            <th> First name </th>
                            <th> Progress </th>
                            <th> Amount </th>
                            <th> Deadline </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face1.jpg" alt="image" />
                            </td>
                            <td> Herman Beck </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $ 77.99 </td>
                            <td> May 15, 2015 </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face2.jpg" alt="image" />
                            </td>
                            <td> Messsy Adam </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $245.30 </td>
                            <td> July 1, 2015 </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face3.jpg" alt="image" />
                            </td>
                            <td> John Richards </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $138.00 </td>
                            <td> Apr 12, 2015 </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face4.jpg" alt="image" />
                            </td>
                            <td> Peter Meggik </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $ 77.99 </td>
                            <td> May 15, 2015 </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face5.jpg" alt="image" />
                            </td>
                            <td> Edward </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $ 160.25 </td>
                            <td> May 03, 2015 </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face6.jpg" alt="image" />
                            </td>
                            <td> John Doe </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $ 123.21 </td>
                            <td> April 05, 2015 </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <img src="../../assets/images/faces/face7.jpg" alt="image" />
                            </td>
                            <td> Henry Tom </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> $ 150.00 </td>
                            <td> June 16, 2015 </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
          
@endsection