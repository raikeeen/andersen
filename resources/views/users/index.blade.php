<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Andersen task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body class="antialiased">
    <div class="container">
        <h3 class="center">Form</h3>
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <input class="form-control" type="text" name="message" placeholder="Message">
            </div>
            <div class="center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            @if ($errors->any())
                <div style="padding-top: 15px">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if (!empty(session('success')))
                <h5 class="success center">{{session('success')}}</h5>
            @endif
        </form>
    </div>
    @empty(!$users->items())
        <div class="conteiner-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td class="ellipsis">{{$user->message}}</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-table">
                        <li class="page-item"><a class="page-link" href="{{$users->previousPageUrl()}}">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="{{$users->url($users->currentPage())}}">{{$users->currentPage()}}</a></li>
                        <li class="page-item"><a class="page-link" href="{{$users->nextPageUrl()}}">Next</a></li>
                    </ul>
                    <div class="pagination-table">
                        <label for="">Page {{$users->currentPage()}} of {{$users->lastPage()}}</label>
                    </div>
                </nav>
        </div>
    @endempty
</body>
</html>
