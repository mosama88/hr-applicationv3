@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-nationalities', 'active')
@section('title', 'تعديل بيانات الجنسية')
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
                        <div class="col-md-12">
                            <h5 class="card-header">تعديل بيانات الجنسية</h5>
                            <form action="{{ route('dashboard.nationalities.update', $nationality->slug) }}" method="POST"
                                id="updateForm">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم الجنسية</label>
                                            <input name="name" type="text"
                                                value="{{ old('name', $nationality->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:مصرى....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlSelect1" class="form-label">حالة الجنسية</label>
                                            <select name="active" class="custom-select @error('active') is-invalid @enderror"
                                                id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected value="">-- أختر الحالة--</option>
                                                <option @if (old('active', $nationality->active) == StatusActiveEnum::ACTIVE) selected @endif
                                                    value="{{ StatusActiveEnum::ACTIVE }}">
                                                    {{ StatusActiveEnum::ACTIVE->label() }}</option>
                                                <option @if (old('active', $nationality->active) == StatusActiveEnum::INACTIVE) selected @endif
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



    <x-card-body-component>
        <form action="{{ route('dashboard.nationalities.store') }}" method="POST" id="storeForm">
            @csrf
            <div class="col-md-12">
                <h5 class="card-header"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">أسم الجنسية</label>
                            <input name="name" type="text" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1"
                                placeholder="مثال:مصرى....">
                            @error('name')
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
    </x-card-body-component>

@endsection
@push('js')
@endpush
