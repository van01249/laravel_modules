@extends('master')

@section('content')
    <div class="content-wrapper">
        @include('layouts.break_crumb')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('school.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên trường (*)</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nhập trường">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Địa chỉ (*)</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Nhập địa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptions">Mô tả (*)</label>
                                        <textarea name="descriptions" class="form-control" id="descriptions" rows="3" placeholder="Nhập mô tả"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại (*)</label>
                                        <input type="number" name="phone" class="form-control" id="phone"
                                            placeholder="Nhập số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email (*)</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập email">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
