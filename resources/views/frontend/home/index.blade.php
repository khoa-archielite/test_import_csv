@extends('frontend.layouts.base')
@section('content')
    <a href=" {{ route('csv.create') }}">Import csv</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('First name') }}</th>
            <th scope="col">{{ __('Last name') }}</th>
            <th scope="col">{{ __('Email') }}</th>
            <th scope="col">{{ __('Phone') }}</th>
            <th scope="col">{{ __('Created') }}</th>
            <th scope="col">{{ __('Updated') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $loop->index + 1  }}</th>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
