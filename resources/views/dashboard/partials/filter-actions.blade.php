<div class="col-3 mx-auto mb-3 text-center">
    <button type="submit" class="btn btn-md btn-primary">فلتر <i class="fa-solid fa-filter mx-1"></i></button>

    <a href="javascript:void(0)" onclick="resetFilters()" class="btn btn-secondary">إمسح<i
            class="fa-solid fa-broom mx-1"></i></a>

</div>
@push('js')
    <script>
        function resetFilters() {
            window.location.href = window.location.pathname;
        }
    </script>
@endpush
