@extends('main')

@section('title', 'User')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::get('success'))
                    <div class="alert alert-success"> {{ Session::get('success') }}</div>
                    @endif
                    @if (Session::get('deleted'))
                        <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
                    @endif
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary" href="{{ route('user.create') }}">Tambah User</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-warning me-3"><i class="bi bi-pencil-square">Edit</i></a>
                                        <form action="{{ route('user.delete', $item['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection