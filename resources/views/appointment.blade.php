@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Pendaftaran Online</div>

                <div class="card-body">
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Doctor</th>
                                <th>Treatment</th>
                                <th>Appointment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tbl_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('appointments.index') }}', 
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user_name', name: 'user_name' },
                { data: 'doctor_name', name: 'doctor_name' }, 
                { data: 'treatment_name', name: 'treatment_name' }, 
                { data: 'appointment_date', name: 'appointment_date' }
            ]
        });
    });
</script>

@endpush