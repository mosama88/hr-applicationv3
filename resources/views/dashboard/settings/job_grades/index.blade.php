@php
    use App\Livewire\JobGradeTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-job_grades', 'active')
@section('title', 'الدرجات الوظيفية')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول الدرجات الوظيفية',
           'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'جدول الدرجات الوظيفية',
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
                                    <x-add-new-button route="job_grades.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الدرجات الوظيفية</h4>

                            </div>
                        </div>
                        @livewire(JobGradeTable::class)
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
