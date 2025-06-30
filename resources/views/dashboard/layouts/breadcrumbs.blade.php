<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ $titlePage }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.' . $url) }}"><i class="{{ $class ?? '' }}"
                                style="color: #5154a4;"></i>{{ $previousPage }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $currentPage }}</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
