@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Assign Subject</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-left: 10%">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">


                            <form method="post" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <select class="form-control" name="class_id" required>
                                            <option value="0">Select Class</option>
                                            @foreach($getClass as $class)
                                                <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Subject Name</label>

                                        @foreach($getSubject as $subject)
                                            @php
                                                $checked = "";
                                            @endphp

                                        @foreach($getSingleSubjectID as $subjectAssign)
                                            @if($subjectAssign->subject_id == $subject->id)
                                                    @php
                                                        $checked = "checked";
                                                    @endphp
                                            @endif
                                        @endforeach
                                            <div>
                                                <label style="font-weight: normal;">
                                                    <input type="checkbox" {{ $checked }} name="subject_id[]" value="{{ $subject->id }}" > &nbsp;&nbsp;{{ $subject->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="0"></option>
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">InActive</option>
                                        </select>
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
