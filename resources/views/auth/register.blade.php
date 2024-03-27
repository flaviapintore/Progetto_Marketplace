<x-layout>

    <x-header title='Registrati' />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5 mb-5 border shadow">
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label mt-5">Username</label>
                        <input type="text" class="form-control" name='name'>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name='email'>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name='password'>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Conferma Password</label>
                        <input type="password" class="form-control" name='password_confirmation'>
                    </div>

                    <button type="submit" class="btn btn-primary mb-5">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
