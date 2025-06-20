@php
    use App\Livewire\GovernorateTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-governorates', 'active')
@section('title', 'المحافظات')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول المحافظات',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول المحافظات',
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
                                    <x-add-new-button route="governorates.create" />
                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول المحافظات</h4>

                            </div>
                        </div>
                        @livewire(GovernorateTable::class)
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
