@extends('layouts.index')

@section('content')
    <section class="content-header">
        <h1>
            User
        </h1>
        <ol class="breadcrumb">
            <li class="active">User</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">Data User</h4>
                        </div>
                        <div class="box-body">
                            <table id="table_pengguna" class="table table-bordered compact">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        <span class="fa fa-cog"></span>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.edit', ['admin' => $user->id]) }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" onclick="this.nextElementSibling.submit()">
                                                                Delete
                                                            </a>
                                                            <form
                                                                action="{{ route('admin.destroy', ['admin' => $user->id]) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Ingin menghapus pengguna?')"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#table_pengguna").DataTable({
            buttons: ['copy', 'csv', 'excel']
        })
    </script>

    @if (session('update_user') === true)
        <script>
            alert('User data changed...')
        </script>
    @endif
    @if (session('destroy_user') === true)
        <script>
            alert('User deleted...')
        </script>
    @endif
@endpush
