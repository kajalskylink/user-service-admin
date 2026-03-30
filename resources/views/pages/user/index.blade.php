<x-main-layout>
    <div class="page-wrapper">
        <div class="content">
            <x-page-header 
                title="User List"
                childTitle="User List"
            >
                <x-slot:buttons>
                    <x-button :url="route('users.create')" class="btn-added" icon="plus-circle">
                        Add User
                    </x-button>
                </x-slot:buttons>
            </x-page-header>

            <div class="card table-list-card">
                <div class="card-body pb-0">
                    @php
                        $headers = [
                            'Name',
                            'Email:lg',
                            'Mobile Number:md',
                            'Password:xl',
                            'Role',
                            'Status',
                            'Last Login:sm',
                            'Action:text-start|no-sort'
                        ];
                    @endphp
                    <x-table id="user-table" :headers="$headers" searchPlaceholder="Search Users...">
                        <x-slot:filter_inputs>
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="mail" class="info-img"></i>
                                        <input type="text" class="form-control filter-input" placeholder="Filter by Email" data-column="1">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="user-check" class="info-img"></i>
                                        <input type="text" class="form-control filter-input" placeholder="Filter by Role" data-column="4">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i data-feather="stop-circle" class="info-img"></i>
                                        <select class="select filter-select" data-column="5" id="filter-status">
                                            <option value="">Filter Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="input-blocks d-flex align-items-center">
                                        <a class="btn btn-filters btn-filter-reset me-2 d-flex align-items-center">
                                            <i data-feather="rotate-ccw" class="feather-16 me-1"></i> Reset
                                        </a>
                                        <a class="btn btn-filters btn-filter-submit d-flex align-items-center">
                                            <i data-feather="search" class="feather-search me-1"></i> Search
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </x-slot:filter_inputs>

                        @forelse($users as $user)
                            <tr class="align-middle">
                                <td>
                                    <div class="user-info-name">
                                        <h6 class="mb-0 text-modern-primary">{{ $user->name ?? 'N/A' }}</h6>
                                        <small class="text-modern-muted">{{ $user->email ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td class="d-none d-lg-table-cell"><span class="text-modern-secondary">{{ $user->email ?? 'N/A' }}</span></td>
                                <td class="d-none d-md-table-cell"><span class="text-modern-secondary">{{ $user->mobile_number ?? $user->phone ?? 'N/A' }}</span></td>
                                <td class="d-none d-xl-table-cell"><span class="text-modern-muted">********</span></td>
                                <td>
                                    @php 
                                        $roleName = 'User';
                                        if (isset($user->roles) && is_array($user->roles) && !empty($user->roles)) {
                                            $role = $user->roles[0];
                                            $roleName = is_array($role) ? ($role['name'] ?? 'User') : ($role->name ?? 'User');
                                        } elseif (isset($user->role)) {
                                            $roleName = $user->role;
                                        }
                                    @endphp
                                    <span class="badge-modern badge-info-soft">{{ $roleName }}</span>
                                </td>
                                <td>
                                    @php $isActive = $user->is_active ?? true; @endphp
                                    <span class="badge-modern {{ $isActive ? 'badge-success-soft' : 'badge-danger-soft' }}">
                                        {{ $isActive ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="d-none d-sm-table-cell"><small class="text-modern-muted">{{ $user->last_login_at ?? 'Never' }}</small></td>
                                <td class="text-center p-0">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a class="action-icon-modern text-primary" href="#" title="View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a class="action-icon-modern text-success" href="#" title="Edit">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <x-delete-button 
                                            :route="route('users.destroy', $user->id)" 
                                            title="Delete User?"
                                            confirmButtonText="Confirm Delete"
                                            class="action-icon-modern text-danger"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
