@extends('dashboard.layouts.master')
@section('title', 'لوحة التحكم')
@section('active-dashboard', 'لوحة التحكم')

@section('content')
    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'لوحة التحكم',
        'previousPage' => '',
        'class' => 'fa-solid fa-house',
        'currentPage' => 'لوحة التحكم',
        'url' => 'index',
    ])
@endsection
