@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <div class="card">
                        <div class="card-content">
                            <h1 class="title">Please enter your email address</h1>
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf

                                @if(session('status'))
                                    <article class="message is-success">
                                        <div class="message-body">
                                           {{ session('status') }}
                                        </div>
                                    </article>
                                @endif

                                <div class="field">
                                    <label for="email">Email</label>
                                    <div class="control">
                                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="email" type="email" name="email" placeholder="e.g. john@example.com" value="{{ old('email') }}">
                                    </div>
                                    @include('layouts.components.form_error', ['field' => 'email'])
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary is-fullwidth">Send password reset link</button>
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
