@props([
    'id'                => 'datatable-' . uniqid(),
    'searchPlaceholder' => 'Search...',
    'showFilter'        => true,
    'showSort'          => false,
    'pagingType'        => 'full_numbers',
    'buttons'           => null,
    'filter_inputs'     => null,
    'thead'             => null,
    'headers'           => null,
])

{{-- ====================== INLINE STYLES ====================== --}}
<style>
    #{{ $id }}-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        gap: 12px;
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 4px;
        flex-wrap: wrap;
    }
    @media (max-width: 575px) {
        #{{ $id }}-toolbar {
            flex-direction: column;
            align-items: stretch;
            padding: 10px 15px;
        }
    }
    #{{ $id }}-search-wrap {
        position: relative;
        width: 280px;
    }
    @media (max-width: 575px) {
        #{{ $id }}-search-wrap {
            width: 100% !important;
        }
    }
    #{{ $id }}-search-wrap svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #999;
        pointer-events: none;
    }
    #{{ $id }}-search-input {
        width: 100%;
        height: 38px;
        padding: 0 14px 0 36px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 13px;
        outline: none;
        transition: all 0.2s;
    }
    #{{ $id }}-search-input:focus {
        border-color: #333;
        box-shadow: 0 0 0 2px rgba(0,0,0,0.02);
    }
    #{{ $id }}-filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0 14px;
        height: 38px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        background: #fff;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    #{{ $id }}-filter-btn svg {
        width: 14px;
        height: 14px;
        transition: transform 0.2s;
    }
    #{{ $id }}-filter-btn:hover,
    #{{ $id }}-filter-btn.is-open {
        background: #111827;
        color: #fff;
        border-color: #111827;
    }
    #{{ $id }}-filter-btn.is-open svg {
        transform: rotate(180deg);
    }

    /* Filter panel */
    #{{ $id }}-filter-panel {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #fff;
    }
    #{{ $id }}-filter-panel.open {
        opacity: 1;
        border-bottom: 1px solid #f3f4f6;
    }
    #{{ $id }}-filter-panel .filter-card {
        padding: 16px 20px;
    }

    /* Professional Table Refinement - PIXEL PERFECT ALIGNMENT */
    .aura-datatable {
        border-collapse: collapse !important; /* "Border to match" fix */
        width: 100% !important;
        margin: 0 !important;
    }
    .aura-datatable thead th {
        background: #f9fafb !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        font-weight: 700 !important;
        color: #4b5563 !important;
        padding: 12px 16px !important;
        border: none !important;
        border-bottom: 1px solid #edf2f7 !important; /* Horizontal borders only */
        white-space: nowrap;
        text-align: left !important;
        position: relative;
    }
    
    /* Remove ghost space from sorting icons in Action header */
    .aura-datatable thead th.no-sort {
        padding-right: 16px !important; 
        background-image: none !important;
        cursor: default !important;
    }
    
    .aura-datatable tbody td {
        padding: 10px 16px !important; 
        vertical-align: middle !important;
        font-size: 13.5px !important;
        color: #1f2937 !important;
        border: none !important;
        border-bottom: 1px solid #f3f4f6 !important; /* Horizontal borders only */
    }
    
    .aura-datatable tbody tr:hover {
        background-color: transparent !important;
    }

    /* Action Icons - Ultra-Refined Modern Style */
    .action-table-data svg, .action-table-data-new svg {
        width: 11px !important;
        height: 11px !important;
        stroke-width: 3px !important;
        transition: transform 0.2s ease;
    }
    .action-table-data a:hover svg, .action-table-data-new a:hover svg {
        transform: scale(1.2);
        opacity: 0.7;
    }
    .action-table-data a, .action-table-data-new a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px !important;
        background: transparent !important;
        border: none !important;
    }

    /* Fix Filter Input Icons */
    .filter-card .input-blocks {
        position: relative !important;
        margin-bottom: 15px !important;
    }
    .filter-card .input-blocks .info-img {
        position: absolute !important;
        left: 12px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 15px !important;
        height: 15px !important;
        color: #6b7280 !important;
        z-index: 10 !important;
    }
    .filter-card .input-blocks input, 
    .filter-card .input-blocks select {
        padding-left: 38px !important; /* Make room for the icon */
        height: 36px !important;
        font-size: 13px !important;
        border-radius: 6px !important;
    }

    /* Pagination wrapper */
    #{{ $id }}_wrapper .dataTables_info {
        float: left;
        padding: 16px 20px;
        font-size: 12px;
        color: #6b7280;
    }
    #{{ $id }}_wrapper .dataTables_paginate {
        float: right;
        padding: 12px 20px;
    }
    #{{ $id }}_wrapper .dataTables_paginate .paginate_button {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        border-radius: 4px !important;
        border: 1px solid #e5e7eb !important;
        background: #fff !important;
        padding: 0 8px !important;
        margin: 0 2px !important;
        color: #374151 !important;
        cursor: pointer;
        font-size: 13px !important;
        font-weight: 500 !important;
    }
    #{{ $id }}_wrapper .dataTables_paginate .paginate_button.current {
        background: #111827 !important;
        border-color: #111827 !important;
        color: #fff !important;
    }
    #{{ $id }}_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) {
        background: #f9fafb !important;
        border-color: #d1d5db !important;
    }
    #{{ $id }}_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.4 !important;
        cursor: not-allowed !important;
    }

    /* Hide DataTables built-in elements */
    #{{ $id }}_wrapper .dataTables_filter, 
    #{{ $id }}_wrapper .dataTables_length { display: none !important; }
</style>

{{-- ====================== TOOLBAR ====================== --}}
<div id="{{ $id }}-toolbar">
    <div id="{{ $id }}-search-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" id="{{ $id }}-search-input" placeholder="{{ $searchPlaceholder }}">
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
        @if ($showFilter)
            <a href="javascript:void(0);" id="{{ $id }}-filter-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filters
            </a>
        @endif
        {{ $buttons ?? '' }}
    </div>
</div>

{{-- ====================== FILTER PANEL ====================== --}}
@if ($filter_inputs)
    <div id="{{ $id }}-filter-panel">
        <div class="filter-card">
            {{ $filter_inputs }}
        </div>
    </div>
@endif

{{-- ====================== TABLE ====================== --}}
<div class="table-responsive">
    <table id="{{ $id }}" class="table aura-datatable {{ $attributes->get('class') }}" style="width:100%;">
        <thead>
        @if ($headers)
            @php
                $processedHeaders = array_map(function($header) {
                    if (is_string($header)) {
                        // Handle shorthand: "Label:lg" or "Label:lg|no-sort" or "Label:start|lg"
                        $parts = explode(':', $header);
                        $label = $parts[0];
                        $class = '';
                        $sortable = true;
                        
                        if (isset($parts[1])) {
                            $opts = explode('|', $parts[1]);
                            foreach ($opts as $opt) {
                                if ($opt === 'sm') $class .= ' d-none d-sm-table-cell';
                                elseif ($opt === 'md') $class .= ' d-none d-md-table-cell';
                                elseif ($opt === 'lg') $class .= ' d-none d-lg-table-cell';
                                elseif ($opt === 'xl') $class .= ' d-none d-xl-table-cell';
                                elseif ($opt === 'no-sort') $sortable = false;
                                elseif ($opt === 'start') $class .= ' text-start';
                                elseif ($opt === 'center') $class .= ' text-center';
                                elseif ($opt === 'end') $class .= ' text-end';
                                else $class .= ' ' . $opt;
                            }
                        }
                        return [
                            'label'    => $label,
                            'class'    => trim($class),
                            'sortable' => $sortable,
                            'checkbox' => ($label === 'checkbox' || $label === '#')
                        ];
                    }
                    return [
                        'label'    => $header['label'] ?? '',
                        'class'    => $header['class'] ?? '',
                        'sortable' => $header['sortable'] ?? true,
                        'checkbox' => $header['checkbox'] ?? false
                    ];
                }, $headers);
            @endphp
            <tr>
                @foreach ($processedHeaders as $header)
                    <th class="{{ !$header['sortable'] ? 'no-sort' : '' }} {{ $header['class'] }}">
                        @if ($header['checkbox'])
                            <label class="checkboxs">
                                <input type="checkbox" id="{{ $id }}-select-all">
                                <span class="checkmarks"></span>
                            </label>
                        @else
                            {{ $header['label'] }}
                        @endif
                    </th>
                @endforeach
            </tr>
        @else
            {{ $thead }}
        @endif
        </thead>
        <tbody>{{ $slot }}</tbody>
    </table>
</div>

{{-- ====================== INLINE SCRIPT ====================== --}}
<script>
(function() {
    // Unique function name to avoid conflicts
    function initTable_{{ Str::replace('-', '_', $id) }}() {
        var tableId = '{{ $id }}';
        var tableEle = $('#' + tableId);
        
        if (!tableEle.length) return;

        // Reset DataTables state if it exists
        if ($.fn.DataTable.isDataTable('#' + tableId)) {
            $('#' + tableId).DataTable().destroy();
        }

        // Detect non-sortable columns
        var columnDefs = [];
        tableEle.find('thead th').each(function(i) {
            if ($(this).hasClass('no-sort')) {
                columnDefs.push({ targets: i, orderable: false });
            }
        });

        // Initialize DataTable
        var dt = tableEle.DataTable({
            destroy: true,
            paging: true,
            searching: true,
            info: true,
            ordering: true,
            columnDefs: columnDefs,
            pageLength: 10,
            dom: 'rtip',
            language: {
                info: "Showing _START_ \u2013 _END_ of _TOTAL_",
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: '<i class="fa fa-angle-right"></i>'
                }
            }
        });

        // Search functionality
        $('#' + tableId + '-search-input').on('keyup', function() {
            dt.search(this.value).draw();
        });

        // Toggle Filter Panel
        var btn = document.getElementById(tableId + '-filter-btn');
        var panel = document.getElementById(tableId + '-filter-panel');
        var filterOpen = false;

        if (btn && panel) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                filterOpen = !filterOpen;
                if (filterOpen) {
                    panel.style.maxHeight = (panel.scrollHeight + 50) + 'px';
                    panel.classList.add('open');
                    btn.classList.add('is-open');
                } else {
                    panel.style.maxHeight = '0';
                    panel.classList.remove('open');
                    btn.classList.remove('is-open');
                }
            });
        }

        // Column Filtering
        $(document).on('click', '.btn-filter-submit', function(e) {
            e.preventDefault();
            if (!panel) return;
            $(panel).find('.filter-input, .filter-select').each(function() {
                var col = $(this).data('column');
                if (col !== undefined) {
                    dt.column(parseInt(col)).search($(this).val());
                }
            });
            dt.draw();
        });

        $(document).on('click', '.btn-filter-reset', function(e) {
            e.preventDefault();
            if (panel) $(panel).find('input, select').val('');
            $('#' + tableId + '-search-input').val('');
            dt.search('').columns().search('').draw();
        });

        // Render Icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    // Run on Load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTable_{{ Str::replace('-', '_', $id) }});
    } else {
        setTimeout(initTable_{{ Str::replace('-', '_', $id) }}, 10);
    }
})();
</script>
