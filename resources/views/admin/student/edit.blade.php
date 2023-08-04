@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Edit Student</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">


                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label>First Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name',$getRecord->name) }}" required placeholder="Enter First Name">
                                            <div style="color: red">{{ $errors->first('name') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Last Name <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name',$getRecord->last_name) }}" required placeholder="Enter Last Name">
                                            <div style="color: red">{{ $errors->first('last_name') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Admission No. <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="admission_number" value="{{ old('admission_number',$getRecord->admission_number) }}" placeholder="Admission No">
                                            <div style="color: red">{{ $errors->first('admission_number') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Roll No. <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="roll_number" value="{{ old('roll_number',$getRecord->roll_number) }}" placeholder="Roll No">
                                            <div style="color: red">{{ $errors->first('roll_number') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Class <span style="color: red">*</span></label>
                                            <select class="form-control" required name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach($getClass as $value)
                                                    <option {{ (old('class_id',$getRecord->class_id) == $value->id) ? 'selected' : '' }} value="{{$value->id}}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            <div style="color: red">{{ $errors->first('class_id') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Gender <span style="color: red">*</span></label>
                                            <select class="form-control" required name="gender">
                                                <option value="">Select Gender</option>
                                                <option  {{ (old('gender',$getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ (old('gender',$getRecord->gender) == 'FeMale') ? 'selected' : '' }} value="FeMale">FeMale</option>
                                                <option {{ (old('gender',$getRecord->gender) == 'Others') ? 'selected' : '' }} value="Others">Others</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('gender') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Date of birth <span style="color: red">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth',$getRecord->date_of_birth) }}" required>
                                            <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Cast <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="cast" value="{{ old('cast',$getRecord->cast) }}" placeholder="Cast">
                                            <div style="color: red">{{ $errors->first('cast') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Religion <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="religion" value="{{ old('religion',$getRecord->religion) }}" placeholder="Religion">
                                            <div style="color: red">{{ $errors->first('religion') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Mobile No <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number',$getRecord->mobile_number) }}" placeholder="Mobile Number">
                                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Admission Date<span style="color: red">*</span></label>
                                            <input type="date" class="form-control" name="admission_date" value="{{ old('admission_date',$getRecord->admission_date) }}" required>
                                            <div style="color: red">{{ $errors->first('admission_date') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Profile Picture <span style="color: red">*</span></label>
                                            <input type="file" class="form-control" name="profile_pic" >
                                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>

                                            @if(!empty($getRecord->getProfile()))
                                                <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                                            @endif

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Blood Group<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group',$getRecord->blood_group) }}" placeholder="Blood Group">
                                            <div style="color: red">{{ $errors->first('blood_group') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Height <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="height" value="{{ old('height',$getRecord->height) }}" placeholder="Height">
                                            <div style="color: red">{{ $errors->first('height') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Weight <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="weight" value="{{ old('weight',$getRecord->weight) }}" placeholder="Weight">
                                            <div style="color: red">{{ $errors->first('weight') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Status <span style="color: red">*</span></label>
                                            <select class="form-control" required name="status">
                                                <option value="">Select Status</option>
                                                <option {{ (old('status',$getRecord->status) == '0') ? 'selected' : '' }} value="0">Active</option>
                                                <option {{ (old('status',$getRecord->status) == '1') ? 'selected' : '' }} value="1">InActive</option>
                                            </select>
                                            <div style="color: red">{{ $errors->first('status') }}</div>
                                        </div>


                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Email<span style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email',$getRecord->email) }}" required placeholder="Enter email">
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="password" required placeholder="Password">
                                        <p>Do you want to change password so please add new password</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card -->


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
