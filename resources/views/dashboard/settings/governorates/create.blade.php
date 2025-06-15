@extends('dashboard.layouts.master')
@section('active-governorates', 'active')
@section('title', 'المحافظات')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />

@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'أضافة محافظة جديدة',
        'previousPage' => 'المحافظات',
        'currentPage' => 'أضافة محافظة جديدة',
        'url' => 'governorates.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.governorates.store') }}" method="POST" id="storeForm">
                            @csrf

                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">أسم المحافظة</label>
                                            <input name="name" type="text" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleFormControlInput1" placeholder="مثال:الاسكندرية....">
                                            @error('name')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="select2Basic" class="form-label">الدولة</label>
                                            <select name="country_id" id="select2Basic"
                                                class="select2 form-select js-example-basic-single @error('country_id') is-invalid @enderror"
                                                data-allow-clear="true">
                                                <option selected value="">--أختر الدولة --</option>
                                                @forelse ($countries as $country)
                                                    <option @if (old('country_id') == $country->id) selected @endif
                                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                                @empty
                                                    <span>عفوآ لا توجد بيانات</span>
                                                @endforelse
                                            </select>
                                            @error('country_id')
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
                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
