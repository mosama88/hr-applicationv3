@php
    use App\Livewire\BranchTable;
    use App\Enums\StatusActiveEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'الفروع')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'جدول الفروع',
        'previousPage' => 'لوحة التحكم',
        'currentPage' => 'جدول الفروع',
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
                                    <x-add-new-button route="branches.create" />


                                </div>
                            </h3>

                            <div class="card-tools">
                                <h4 class="mb-0">جدول الفروع</h4>

                            </div>
                        </div>
                        @livewire(BranchTable::class)

                    </div>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>


@endsection
@push('js')
@endpush
