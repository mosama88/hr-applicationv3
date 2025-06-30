@php
    use App\Livewire\JobCategoryTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-job_categories', 'active')
@section('title', 'الوظائف')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول الوظائف',
           'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'جدول الوظائف',
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
                                    <x-add-new-button route="job_categories.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الوظائف</h4>
                            </div>
                        </div>
                        @livewire(JobCategoryTable::class)
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
