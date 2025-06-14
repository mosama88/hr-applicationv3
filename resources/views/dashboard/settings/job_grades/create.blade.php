@extends('dashboard.layouts.master')
@section('active-job_grades', 'active')
@section('title', 'الدرجات الوظيفية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.job_grades.store') }}" method="POST" id="storeForm">
                            @csrf
                            <div class="col-md-12">
                                <h5 class="card-header">أضافة درجه وظيفية جديدة</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الدرجه
                                                الوظيفية</label>
                                            <input name="name" type="text" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:الدرجه الاولى....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">الحد الأدنى
                                                للمرتب</label>
                                            <input name="min_salary" type="text" value="{{ old('min_salary') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^0+/, '');"
                                                class="form-control @error('min_salary') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:5000....">
                                            @error('min_salary')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">الحد الأقصى
                                                للمرتب</label>
                                            <input name="max_salary" type="text" value="{{ old('max_salary') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^0+/, '');"
                                                class="form-control @error('max_salary') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:7000....">
                                            @error('max_salary')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">ملاحظات</label>
                                            <input name="notes" type="text" value="{{ old('notes') }}"
                                                class="form-control @error('notes') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:ملاحظات....">
                                            @error('notes')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <x-create-button-component></x-create-button-component>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
