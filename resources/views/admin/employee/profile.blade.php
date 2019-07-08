<!-- Profile Image -->
<div class="box box-primary box-outline">
    <div class="box-body box-profile">
    <div class="text-muted text-center">
        @if($employee->avatar != "")
            <img class="profile-user-img img-fluid img-box"
            src="{{ asset('storage/'.$employee->avatar) }}"
            alt="User profile picture">
        @else 
            <img class="profile-user-img img-fluid img-box"
            src="/uploads/avatar/profile.png"
            alt="User profile picture">
        @endif
    </div>
    <div class="text-center">
    <a href="{{ route('admin.employee.avatar.create', $employee->id) }}" class="btn btn-default btn-xs">
        <i class="fa fa-upload"></i>&nbsp;Change Avatar
        </a>
    </div>

    <h3 class="profile-username text-center">
        {{ $employee->nama }}
    </h3>
    <p class="text-center">
        {{ $employee->nip }}
    </p>
    <p class="text-center">
        {{ $employee->nik }}
    </p>
    <p class="text-muted text-center">
        {{ $employee->position->name }}
    </p>
    <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
        <b>Division</b>
        {{ $employee->position->division->name }}
        </li>
        <li class="list-group-item">
        <b>Department</b>
        @if($employee->position->department)
        {{ $employee->position->department->name }}
        @else 
        -
        @endif
        </li>
        <li class="list-group-item">
        <b>Section</b>
        @if($employee->position->section)
        {{ $employee->position->section->name }}
        @else 
        -
        @endif
        </li>

        <li class="list-group-item">
        <b>Head</b>
        @if($employee->position->parent != null)
        {{ $employee->position->parent->name }}
        @else 
        -
        @endif
        </li>
        <li class="list-group-item">
        <b>Head Name</b>
        @if($employee->head != null)
        {{ $employee->head->nama }}
        @else 
        -
        @endif
        </li>
    </ul>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->