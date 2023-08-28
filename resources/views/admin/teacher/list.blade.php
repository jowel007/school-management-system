@extends('layouts.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher List (Total : {{ $getRecord->total() }} ) </h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add New Teacher</a>
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
                        <h3 class="card-title">Search Teacher</h3>
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
                                    <label>Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_number" value="{{ Request::get('mobile_number') }}"  placeholder="Enter Mobile No">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Marital Status</label>
                                    <input type="text" class="form-control" name="marital_status" value="{{ Request::get('marital_status') }}"  placeholder="Marital Status">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Current Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ Request::get('address') }}"  placeholder="Marital Status">
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
                                    <label>Date of joining</label>
                                    <input type="date" class="form-control" name="admission_date" value="{{ Request::get('admission_date') }}"  >
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Created Date</label>
                                    <input type="date" class="form-control" name="created_at" value="{{ Request::get('created_at') }}"  placeholder="Enter Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                    <a href="{{ url('admin/teacher/list') }}" class="btn btn-success" style="margin-top: 30px">Clear</a>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>

                <!-- /.card -->




                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">
                        @include("_message")
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Teacher List </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Profile Picture </th>
                                        <th>Teacher Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Date of birth</th>
                                        <th>Date of Joining</th>
                                        <th>Mobile No</th>
                                        <th>Marital Status</th>
                                        <th>Current Address</th>
                                        <th>parmanent Address</th>
                                        <th>Qualification</th>
                                        <th>Work Experince</th>
                                        <th>Note</th>
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
                                            <td>{{ ($value->gender) }}</td>
                                            <td>
                                                @if (!empty($value->date_of_birth))
                                                    {{ date('d-m-Y',strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($value->date_of_joining))
                                                    {{ date('d-m-Y',strtotime($value->date_of_joining)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>{{ $value->marital_status }}</td>
                                            <td>{{ $value->current_address }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->qualification }}</td>
                                            <td>{{ $value->work_experiance }}</td>
                                            <td>{{ $value->note }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td style="min-width:150px">
                                                <a href="{{ url('admin/teacher/edit/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/teacher/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
