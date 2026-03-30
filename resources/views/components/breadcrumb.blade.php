@props([
    'items' => [], // Array of ['name' => 'Name', 'url' => 'URL']
])

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home" class="feather-16"></i></a></li>
    @foreach($items as $item)
        @if($loop->last)
            <li class="breadcrumb-item active">{{ $item['name'] }}</li>
        @else
            <li class="breadcrumb-item"><a href="{{ $item['url'] ?? '#' }}">{{ $item['name'] }}</a></li>
        @endif
    @endforeach
</ul>
