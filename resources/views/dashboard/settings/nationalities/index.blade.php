@php
    use App\Livewire\NationalityTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-nationalities', 'active')
@section('title', 'الجنسيات')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول الجنسيات',
           'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'جدول الجنسيات',
        'url' => 'index',
    ])


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- الزر على اليسار -->


                                    <!-- النص على اليمين -->
                                    <x-add-new-button route="nationalities.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الجنسيات</h4>

                            </div>
                        </div>
                        @livewire(NationalityTable::class)
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
