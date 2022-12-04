@extends('frontend.layouts.base')
@section('content')

    <div class="container">
        <h1 class="title text-center">
            User list
        </h1>

        <a href=" {{ route('csv.create') }}" class="m-auto">
            <button class="btn btn-primary  mb-5">Import csv</button>
        </a>

        <table class="table">
            <thead class="table-dark">
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
                    <th scope="row">{{ $user->id  }}</th>
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

        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
