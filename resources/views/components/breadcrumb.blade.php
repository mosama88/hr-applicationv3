@foreach ($breadcrumbs as $breadcrumb)
    @if ($loop->last)
        {{ ucfirst($breadcrumb['text']) }}
    @else
        <a href="{{ $breadcrumb['url'] }}">
            {{ ucfirst($breadcrumb['text']) }} /
        </a>
    @endif
@endforeach
