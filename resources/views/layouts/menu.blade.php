@php use Spatie\Permission\Models\Role; @endphp
@hasanyrole('super admin|doctor|manager')
<li class="nav-item">
    <a href="{{ route('admin.home.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.home.index' ? 'active' : '' }}"><i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
@else
<li class="nav-item">
    <a href="{{ route('home.index') }}" class="nav-link {{ Request::route()->getName() == 'home.index' ? 'active' : '' }}"><i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
@endhasanyrole
@hasrole('super admin')
<li class="nav-item">
    <a href="{{ route('admin.role.index') }}" class="nav-link {{ Request::route()->getName() == "admin.role.index" ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>Roles</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('super admin')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('super admin')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>Admins</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('manager')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('manager')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>Managers</p>
    </a>

</li>
<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('patient')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('patient')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Patients</p>
    </a>

</li>
<li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && empty(Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>All Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('patient')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('patient')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Files</p>
    </a>
</li>
@endhasrole
@hasanyrole('super admin|manager')

<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('doctor')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('doctor')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Doctors</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('schedule.index') }}" class="nav-link {{ Request::route()->getName() == "schedule.index" ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-day"></i>
        <p>Schedules</p>
    </a>

</li>
@endhasanyrole
@hasrole('doctor')
<li class="nav-item">
    <a href="{{ route('schedule.index') }}" class="nav-link {{ Request::route()->getName() == "schedule.index" ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-day"></i>
        <p>Schedules</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('appointment.index') }}" class="nav-link {{ Request::route()->getName() == "appointment.index" ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Appointments</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('patient')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('patient')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-injured"></i>
        <p>Patients</p>
    </a>
</li>
@endhasrole
@hasrole('patient')
<li class="nav-item">
    <a href="{{ route('schedule.index') }}" class="nav-link {{ Request::route()->getName() == "schedule.index" ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-day"></i>
        <p>Schedules</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('appointment.index') }}" class="nav-link {{ Request::route()->getName() == "appointment.index" ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>Appointments</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('patient')->id]) }}" class="nav-link {{ Request::route()->getName() == "user.index"
               && in_array(Role::findByName('patient')->id, Request::query('result_type', [])) ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Files</p>
    </a>
</li>
@endhasanyrole
