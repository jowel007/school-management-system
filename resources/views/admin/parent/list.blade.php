@extends('layouts.app')

@section('content')

<div class="content-wrapper" style="min-height: 1302.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent List (Total : {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
                  <!-- general form elements -->
          <div class="card">

              <div class="card-header">
                  <h3 class="card-title">Search Parents</h3>
              </div>

              <form method="get" action="">

                  <div class="card-body">
                      <div class="row">
                          <div class="form-group col-md-2">
                              <label>Name</label>
                              <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}"  placeholder="Enter Name">
                          </div>
                          <div class="form-group col-md-2">
                              <label>Last Name</label>
                              <input type="text" class="form-control" name="lastname" value="{{ Request::get('lastname') }}"  placeholder="Enter Name">
                          </div>
                          <div class="form-group col-md-2">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value="{{ Request::get('email') }}"  placeholder="Enter email">
                          </div>


                          <div class="form-group col-md-2">
                              <label>Gender</label>
                              <select class="form-control" name="gender">
                                  <option value="">Select Gender</option>
                                  <option  {{ Request::get('gender') == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                  <option {{ Request::get('gender') == 'FeMale' ? 'selected' : '' }} value="FeMale">FeMale</option>
                                  <option {{ Request::get('gender') == 'Others' ? 'selected' : '' }} value="Others">Others</option>
                              </select>

                          </div>

                          <div class="form-group col-md-2">
                              <label>Occupation</label>
                              <input type="text" class="form-control" name="occupation" value="{{ Request::get('ooccupation') }}"  placeholder="Enter Occupation">
                          </div>

                          <div class="form-group col-md-2">
                              <label>Address</label>
                              <input type="text" class="form-control" name="address" value="{{ Request::get('address') }}"  placeholder="Enter Address">
                          </div>

                          <div class="form-group col-md-2">
                              <label>Mobile No</label>
                              <input type="text" class="form-control" name="mobile_number" value="{{ Request::get('mobile_number') }}"  placeholder="Enter Mobile No">
                          </div>


                          <div class="form-group col-md-2">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                  <option value="">Select Status</option>
                                  <option  {{ Request::get('status') == '100' ? 'selected' : '' }} value="100">Active</option>
                                  <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">InActive</option>
                              </select>

                          </div>



                          <div class="form-group col-md-2">
                              <label>Created Date</label>
                              <input type="date" class="form-control" name="created_at" value="{{ Request::get('created_at') }}"  placeholder="Enter Date">
                          </div>
                          <div class="form-group col-md-3">
                              <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                              <a href="{{ url('admin/parent/list') }}" class="btn btn-success" style="margin-top: 30px">Clear</a>
                          </div>
                      </div>

                  </div>


              </form>
          </div>

                            <!-- /.card -->
                  <!-- /.card -->




        <div class="row">

          <!-- /.col -->
          <div class="col-md-12">
              @include("_message")
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Parent List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Profile Pic</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Occupation</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($getRecord as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>
                            @if (!empty($value->getProfile()))
                                <img src="{{ $value->getProfile() }}" style="width: 70px; height: 60px; border-radius:50px">
                            @endif

                        </td>
                        <td>{{ $value->name }}{{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->mobile_number }}</td>
                        <td>{{ $value->occupation }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                        <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                        <td>
                            <a href="{{ url('admin/parent/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('admin/parent/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            <a href="{{ url('admin/parent/my-student/'.$value->id) }}" class="btn btn-primary">My Student</a>
                        </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
