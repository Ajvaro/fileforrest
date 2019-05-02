@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <div class="card">
                        <div class="card-content">
                            <h1 class="title">Let's get you ready for selling</h1>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf

                                <div class="field">
                                    <label for="name">Name</label>
                                    <div class="control">
                                        <input id="name" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name" placeholder="e.g. John Doe" value="{{ old('name') }}">
                                    </div>
                                    @include('layouts.components.form_error', ['field' => 'name'])
                                </div>

                                <div class="field">
                                    <label for="email">Email</label>
                                    <div class="control">
                                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="email" type="email" name="email" placeholder="e.g. john@example.com" value="{{ old('email') }}">
                                    </div>
                                    @include('layouts.components.form_error', ['field' => 'email'])
                                </div>

                                <div class="field">
                                    <label for="password">Password</label>
                                    <div class="control">
                                        <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" id="password" name="password" type="password">
                                    </div>
                                    @include('layouts.components.form_error', ['field' => 'password'])
                                </div>

                                <div class="field">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="control">
                                        <input class="input" id="password_confirmation" name="password_confirmation" type="password">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary is-fullwidth">Sign up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
