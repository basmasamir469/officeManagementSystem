@extends('layouts.admin')

@section('title', 'Create Employee')
@section('subtitle', 'Add a new employee record')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Employee</h3>
    </div>
    <div class="card-body">
        <div id="ajax-form-response"></div>
        <form id="employee-create-form" action="{{ route('admin.employees.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Salary</label>
                <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Hire Date</label>
                <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success" id="employee-submit-button">Save Employee</button>
                <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Back to employees</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
(function () {
    const form = document.getElementById('employee-create-form');
    const responseContainer = document.getElementById('ajax-form-response');
    const submitButton = document.getElementById('employee-submit-button');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || form.querySelector('input[name="_token"]')?.value;

    if (!form) {
        return;
    }

    const setMessage = (type, message) => {
        responseContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                ${message}
            </div>
        `;
    };

    const showValidationErrors = (errors) => {
        const messages = Object.values(errors).flat().map(text => `<div>${text}</div>`).join('');
        setMessage('danger', messages);
    };

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        responseContainer.innerHTML = '';
        submitButton.disabled = true;

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: new FormData(this),
            });

            const payload = await response.json().catch(() => null);

            if (response.ok) {
                setMessage('success', payload?.message || 'Employee created successfully. Redirecting...');
                window.setTimeout(() => {
                    window.location.href = payload?.redirect || '{{ route('admin.employees.index') }}';
                }, 700);
                return;
            }

            if (response.status === 422 && payload?.errors) {
                showValidationErrors(payload.errors);
                return;
            }

            setMessage('danger', payload?.message || 'Unable to save employee.');
        } catch (error) {
            setMessage('danger', error.message || 'Unable to save employee.');
        } finally {
            submitButton.disabled = false;
        }
    });
})();
</script>
@endsection
