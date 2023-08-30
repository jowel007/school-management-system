@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> My Account</h1>
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
                        @include('_message')
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
                                            <label>Profile Picture <span style="color: red">*</span></label>
                                            <input type="file" class="form-control" name="profile_pic" >
                                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>

                                            @if(!empty($getRecord->getProfile()))
                                                <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                                            @endif

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
                                            <label>Mobile No <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number',$getRecord->mobile_number) }}">
                                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Marital Status <span style="color: red"></span></label>
                                            <input type="text" class="form-control" name="marital_status" value="{{ old('marital_status',$getRecord->marital_status) }}" >
                                            <div style="color: red">{{ $errors->first('marital_status') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Current Address <span style="color: red"></span></label>
                                            <textarea type="text" rows="4" class="form-control" name="current_address" placeholder="Current Address">{{ old('current_address',$getRecord->current_address) }} </textarea>
                                            <div style="color: red">{{ $errors->first('current_address') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Parmanent Address <span style="color: red"></span></label>
                                            <textarea type="text" rows="4" class="form-control" name="address" placeholder="Address">{{ old('address',$getRecord->address) }} </textarea>
                                            <div style="color: red">{{ $errors->first('address') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Qualification <span style="color: red"></span></label>
                                            <textarea type="text" rows="4" class="form-control" name="qualification" >{{ old('qualification',$getRecord->qualification) }} </textarea>
                                            <div style="color: red">{{ $errors->first('qualification') }}</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Work Experenced <span style="color: red"></span></label>
                                            <textarea type="text" rows="4" class="form-control" name="work_experiance"> {{ old('work_experiance',$getRecord->work_experiance) }}</textarea>
                                            <div style="color: red">{{ $errors->first('work_experiance') }}</div>
                                        </div>


                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Email<span style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email',$getRecord->email) }}" required placeholder="Enter email">
                                        <div style="color: red">{{ $errors->first('email') }}</div>
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
