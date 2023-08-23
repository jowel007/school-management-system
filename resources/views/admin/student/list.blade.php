@extends('layouts.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
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
                        <h3 class="card-title">Search Student</h3>
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
                                    <label>Admission No.</label>
                                    <input type="text" class="form-control" name="admission_number" value="{{ Request::get('admission_number') }}"  placeholder="Enter Admission No.">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Roll NO</label>
                                    <input type="text" class="form-control" name="roll_number" value="{{ Request::get('roll_number') }}"  placeholder="Enter Roll NO">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Class</label>
                                    <input type="text" class="form-control" name="class" value="{{ Request::get('class') }}"  placeholder="Enter Class">
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
                                    <label>Cast</label>
                                    <input type="text" class="form-control" name="cast" value="{{ Request::get('cast') }}"  placeholder="Enter Cast">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Religion</label>
                                    <input type="text" class="form-control" name="religion" value="{{ Request::get('religion') }}"  placeholder="Enter Religion">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_number" value="{{ Request::get('mobile_number') }}"  placeholder="Enter Mobile No">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Blood Group</label>
                                    <input type="text" class="form-control" name="blood_group" value="{{ Request::get('blood_group') }}"  placeholder="Enter Blood Group">
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
                                    <label>Admission Date</label>
                                    <input type="date" class="form-control" name="admission_date" value="{{ Request::get('admission_date') }}"  >
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Created Date</label>
                                    <input type="date" class="form-control" name="created_at" value="{{ Request::get('created_at') }}"  placeholder="Enter Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                                    <a href="{{ url('admin/student/list') }}" class="btn btn-success" style="margin-top: 30px">Clear</a>
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
                                <h3 class="card-title">All Student List </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Profile Picture </th>
                                        <th>Student Name</th>
                                        <th>Parent Name</th>
                                        <th>Email</th>
                                        <th>Admission No.</th>
                                        <th>Roll No.</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>Date of birth</th>
                                        <th>Cast</th>
                                        <th>Religion</th>
                                        <th>Mobile No</th>
                                        <th>Admission Date</th>
                                        <th>Blood Group</th>
                                        <th>Height</th>
                                        <th>Weight</th>
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
                                            <td>{{ $value->parent_name }}{{ $value->parent_last_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->admission_number }}</td>
                                            <td>{{ $value->roll_number }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>
                                                @if (!empty($value->date_of_birth))
                                                    {{ date('d-m-Y',strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->cast }}</td>
                                            <td>{{ $value->religion }}</td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>
                                                @if (!empty($value->admission_date))
                                                    {{ date('d-m-Y',strtotime($value->admission_date)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->blood_group }}</td>
                                            <td>{{ $value->height }}</td>
                                            <td>{{ $value->weight }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td style="min-width:150px">
                                                <a href="{{ url('admin/student/edit/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/student/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
