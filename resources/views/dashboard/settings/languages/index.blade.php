@php
    use App\Livewire\LanguageTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-languages', 'active')
@section('title', 'اللغات')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول اللغات',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول اللغات',
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
                                    <x-add-new-button route="languages.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول اللغات</h4>

                            </div>
                        </div>
                        @livewire(LanguageTable::class)
                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
