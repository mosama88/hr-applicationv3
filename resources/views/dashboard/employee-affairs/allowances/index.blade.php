@php
    use App\Livewire\AllowanceTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-allowances', 'active')
@section('title', 'أنواع البدلات')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول أنواع البدلات',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول أنواع البدلات',
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
                                    <x-add-new-button route="allowances.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول أنواع البدلات</h4>

                            </div>
                        </div>
                        @livewire(AllowanceTable::class)


                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
