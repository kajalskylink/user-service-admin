@props([
    'route',
    'title' => 'Are you sure?',
    'text' => 'You will not be able to revert this!',
    'icon' => 'warning',
    'confirmButtonText' => 'Yes, delete it!',
    'cancelButtonText' => 'Cancel',
    'class' => 'me-2 p-0',
])

@php
    $id = 'delete-form-' . uniqid();
@endphp

<form id="{{ $id }}" action="{{ $route }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<a href="javascript:void(0);" 
   onclick="confirmDelete_{{ Str::replace('-', '_', $id) }}()" 
   {{ $attributes->merge(['class' => $class]) }}
   title="Delete">
    <i data-feather="trash-2" class="feather-trash-2 text-danger"></i>
</a>

<script>
    function confirmDelete_{{ Str::replace('-', '_', $id) }}() {
        if (typeof Swal === 'undefined') {
            // Fallback to native confirm if Swal is not loaded
            if (confirm('{{ $title }}\n{{ $text }}')) {
                document.getElementById('{{ $id }}').submit();
            }
            return;
        }

        Swal.fire({
            title: '{{ $title }}',
            text: '{{ $text }}',
            icon: '{{ $icon }}',
            showCancelButton: true,
            confirmButtonColor: '#1b2850',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ $confirmButtonText }}',
            cancelButtonText: '{{ $cancelButtonText }}',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('{{ $id }}').submit();
            }
        });
    }
</script>
