@extends('layouts.admin')

@section('title', 'Employees')
@section('subtitle', 'Manage company employees')

@section('header_actions')
<a href="{{ route('admin.employees.create') }}" class="btn btn-primary">New Employee</a>
@endsection

@section('content_body')
<div id="ajax-alert-container"></div>
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="employees-table-body">
                @forelse($employees as $employee)
                    <tr data-employee-row="{{ $employee->id }}">
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>${{ number_format($employee->salary, 2) }}</td>
                        <td>{{ $employee->hire_date->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="ajax-delete-form d-inline" data-employee-id="{{ $employee->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
(function () {
    const alertContainer = document.getElementById('ajax-alert-container');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('input[name="_token"]')?.value;

    const showAlert = (type, message) => {
        if (!alertContainer) return;
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                ${message}
            </div>
        `;
    };

    document.querySelectorAll('.ajax-delete-form').forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (!confirm('Delete this employee?')) {
                return;
            }

            const row = form.closest('tr');
            const formData = new FormData(form);
            formData.set('_method', 'DELETE');

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                });

                if (!response.ok) {
                    const payload = await response.json().catch(() => null);
                    throw new Error(payload?.message || 'Unable to delete employee.');
                }

                const data = await response.json();
                if (row) row.remove();
                showAlert('success', data.message || 'Employee deleted successfully.');

                if (!document.querySelector('#employees-table-body tr')) {
                    document.querySelector('#employees-table-body').innerHTML = '<tr><td colspan="6" class="text-center text-muted">No employees found.</td></tr>';
                }
            } catch (error) {
                showAlert('danger', error.message || 'Unable to delete employee.');
            }
        });
    });
})();
</script>
@endsection
