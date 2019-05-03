@extends('account.layouts.default')

@section('account.content')

    <h1 class="title">Sell a file</h1>

    <form action="{{ route('account.files.store', $file) }}" method="POST">
        @csrf
        <div class="columns">
            <div class="column is-three-quarters">
                <div class="field">
                    <label for="title" class="label">Title</label>
                    <div class="control">
                        <input type="text" name="title" id="title" class="input{{ $errors->has('title') ? ' is-danger' : '' }}">
                        @include('layouts.components.form_error', ['field' => 'title'])
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="field">
                    <label for="price" class="label">Price (&#163;)</label>
                    <div class="control">
                        <input type="number" name="price" step="any" min="0" id="price"
                               onblur="validate(this)"
                               class="input{{ $errors->has('price') ? ' is-danger' : '' }}">
                        @include('layouts.components.form_error', ['field' => 'price'])
                    </div>
                </div>
            </div>
        </div>

        <div class="field">
            <label for="overview_short" class="label">Short overview</label>
            <div class="control">
                <input type="text" name="overview_short" id="overview_short" class="input{{ $errors->has('overview_short') ? ' is-danger' : '' }}">
                @include('layouts.components.form_error', ['field' => 'overview_short'])
            </div>
        </div>

        <div class="field">
            <label for="overview" class="label">Overview</label>
            <div class="control">
                <textarea name="overview" id="overview" class="textarea{{ $errors->has('overview') ? ' is-danger' : '' }}" rows="5"></textarea>
                @include('layouts.components.form_error', ['field' => 'overview'])
            </div>
        </div>

        <div class="field">
            <div class="control">
                <p class="has-text-warning"><i class="fa fa-asterisk"> </i> Your file needs to be reviewed before it goes live</p>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary is-fullwidth">Submit</button>
            </div>
        </div>
    </form>

    <script>
        function validate(el) {
            let v = parseFloat(el.value);
            el.value = (isNaN(v)) ? '' : v.toFixed(2);
        }
    </script>
@endsection