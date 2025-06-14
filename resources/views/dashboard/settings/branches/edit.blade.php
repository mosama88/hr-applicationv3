@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'تعديل بيانات الفرع')
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
                            <h4> تعديل بيانات الفرع
                            </h4>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="col-md-12">
                            <form action="{{ route('dashboard.branches.update', $branch->slug) }}" method="POST"
                                id="updateForm">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الفرع</label>
                                            <input name="name" value="{{ old('name', $branch->name) }}" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:فرع....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                                الفرع</label>
                                            <input name="phones" class="form-control @error('phones') is-invalid @enderror"
                                                value="{{ old('name', $branch->phones) }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                            @error('phones')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                                الالكترونى
                                            </label>
                                            <input name="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $branch->email) }}" type="text"
                                                id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                            @error('email')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">حالة الفرع</label>
                                            <select name="active" class="custom-select @error('active') is-invalid @enderror"
                                                id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('active', $branch->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                <option @if (old('active', $branch->active) == StatusActiveEnum::INACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::INACTIVE }}">
                                                    {{ StatusActiveEnum::INACTIVE->label() }}</option>
                                            </select>

                                            
                                            @error('active')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-12 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">عنوان الفرع
                                        </label>
                                        <input name="address" class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address', $branch->address) }}" type="text"
                                            id="exampleFormControlReadOnlyInput1" placeholder="21 ش...">
                                        @error('address')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                </div>
                        </div>
                        <!-- /.card-body -->
                        <x-edit-button-component></x-edit-button-component>

                        </form>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
