@php
    use App\Livewire\DepartmentTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-departments', 'active')
@section('title', 'الادارات')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول الادارات',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول الادارات',
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
                                    <x-add-new-button route="departments.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الادارات</h4>

                            </div>
                        </div>
                        @livewire(DepartmentTable::class)
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
