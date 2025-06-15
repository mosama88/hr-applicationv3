@php
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'عرض بيانات الفرع')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->

    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'عرض بيانات الفرع',
        'previousPage' => 'الفروع',
        'currentPage' => 'عرض بيانات الفرع ',
        'url' => 'branches.index',
    ])


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark card-outline mb-4">
                        <!--begin::Header-->

                        <!--end::Header-->
                        <!--begin::Form-->

                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">أسم الفرع</label>
                                        <input disabled name="name" type="text"
                                            value="{{ old('name', $branch->name) }}"
                                            class="form-control bg-white @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="مثال:فرع....">
                                        @error('name')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">هاتف
                                            الفرع</label>
                                        <input disabled name="phones" value="{{ old('phones', $branch->phones) }}"
                                            class="form-control bg-white @error('phones') is-invalid @enderror"
                                            type="text" id="exampleFormControlReadOnlyInput1" placeholder="010...">
                                        @error('phones')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="exampleFormControlReadOnlyInput1" class="form-label">البريد
                                            الالكترونى
                                        </label>
                                        <input disabled name="email" value="{{ old('email', $branch->email) }}"
                                            class="form-control bg-white @error('email') is-invalid @enderror"
                                            type="text" id="exampleFormControlReadOnlyInput1" placeholder="p@p.com...">
                                        @error('email')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-12 mb-3">
                                    <label for="exampleFormControlReadOnlyInput1" class="form-label">عنوان الفرع
                                    </label>
                                    <input disabled name="address" value="{{ old('address', $branch->address) }}"
                                        class="form-control bg-white @error('address') is-invalid @enderror" type="text"
                                        id="exampleFormControlReadOnlyInput1" placeholder="21 ش...">
                                    @error('address')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">حالة الفرع</label>
                                    <select disabled name="active"
                                        class="form-select bg-white @error('active') is-invalid @enderror"
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
                        </div>
                        <!-- /.card-body -->


                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
