@extends('dashboard.layouts.app')

@section('title', __('dashboard.roles.create'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.roles.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="create-role-form">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="name">@lang('dashboard.role.name')</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('dashboard.enter') @lang('dashboard.name')">
                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.page')</th>
                                <th>@lang('dashboard.roles')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('dashboard.tenants')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::tenants_show->value }}" value="{{ \App\Enums\PermissionsType::tenants_show->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::tenants_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::tenants_edit->value }}" value="{{ \App\Enums\PermissionsType::tenants_edit->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::tenants_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::tenants_delete->value }}" value="{{ \App\Enums\PermissionsType::tenants_delete->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::tenants_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::tenants_create->value }}" value="{{ \App\Enums\PermissionsType::tenants_create->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::tenants_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.users')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::users_show->value }}" value="{{ \App\Enums\PermissionsType::users_show->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::users_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::users_edit->value }}" value="{{ \App\Enums\PermissionsType::users_edit->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::users_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::users_delete->value }}" value="{{ \App\Enums\PermissionsType::users_delete->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::users_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::users_create->value }}" value="{{ \App\Enums\PermissionsType::users_create->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::users_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.roles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::roles_show->value }}" value="{{ \App\Enums\PermissionsType::roles_show->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::roles_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::roles_edit->value }}" value="{{ \App\Enums\PermissionsType::roles_edit->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::roles_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::roles_delete->value }}" value="{{ \App\Enums\PermissionsType::roles_delete->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::roles_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enums\PermissionsType::roles_create->value }}" value="{{ \App\Enums\PermissionsType::roles_create->value }}">
                                        <label class="form-check-label" for="{{ \App\Enums\PermissionsType::roles_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">@lang('dashboard.create')</button>
        </div>
    </div>
</form>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/roles.js') }}"></script>
@endsection