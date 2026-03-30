@props([
    'title',
    'parentTitle' => null,
    'parentRoute' => null,
    'childTitle'  => null,
    'childRoute'  => null,
    'buttons'     => null,
])

<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <x-breadcrumb
                :items="array_filter([
                    $parentTitle ? ['name' => $parentTitle, 'url' => $parentRoute] : null,
                    $childTitle  ? ['name' => $childTitle,  'url' => $childRoute]  : null,
                ])"
            />
        </div>
    </div>
    @if($buttons)
        <div class="page-btn">
            {{ $buttons }}
        </div>
    @endif
</div>
