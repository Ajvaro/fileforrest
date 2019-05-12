@extends('account.layouts.default')

@section('account.content')

    <h1 class="title">Make changes</h1>

    @if($approval)
      @include('account.files.partials.approval_data', compact('approval', 'file'))
    @endif

    <div class="field">
        <label class="label">Upload files</label>
        <div class="control">
            <dropzone
                    :uuid="{{ json_encode($file->identifier) }}"
                    :uploads="{{ json_encode($file->uploads) }}"
                    :error="{{ json_encode($errors->first('uploads') ?? false) }}"
            > </dropzone>
        </div>
    </div>

    <form action="{{ route('account.files.update', $file) }}" method="POST">
        @csrf
        @method('PATCH')

        <input type="hidden" name="checkbox" value="0">

        <div class="columns">
            <div class="column is-half">
                <div class="field">
                    <label for="title" class="label">Title</label>
                    <div class="control">
                        <input type="text" name="title" id="title" class="input{{ $errors->has('title') ? ' is-danger' : '' }}" value="{{ old('title') ?? $file->title }}">
                        @include('layouts.components.form_error', ['field' => 'title'])
                    </div>
                </div>
            </div>
            <div class="column is-one-third">
                <file-price
                        :initial_price="{{ json_encode(old('price') ?? money($file->price)->formatByDecimal()) }}"
                        :input_error="{{ json_encode($errors->first('price') ?? false) }}">
                </file-price>
            </div>

            <div class="column">
                <div class="field">
                    <label for="live" class="label">Live</label>
                    <label class="checkbox">
                    <input type="checkbox" name="live" id="live"{{ $file->live ? ' checked' : '' }} value="1">
                    Live
                </label>
                </div>
            </div>
        </div>

        <div class="field">
            <label for="overview_short" class="label">Short overview</label>
            <div class="control">
                <input type="text"
                       name="overview_short"
                       id="overview_short"
                       class="input{{ $errors->has('overview_short') ? ' is-danger' : '' }}"
                       value="{{ old('overview_short') ?? $file->overview_short }}">
                @include('layouts.components.form_error', ['field' => 'overview_short'])
            </div>
        </div>

        <div class="field">
            <label for="overview" class="label">Overview</label>
            <div class="control">
                <textarea name="overview"
                          id="overview"
                          class="textarea{{ $errors->has('overview') ? ' is-danger' : '' }}"
                          rows="5">{{ old('overview') ?? $file->overview }}</textarea>
                @include('layouts.components.form_error', ['field' => 'overview'])
            </div>
        </div>

        <div class="field">
            <div class="control">
                <p class="has-text-warning"><i class="fa fa-asterisk"> </i> Your file changes may be subject to review</p>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary is-fullwidth">Update file data</button>
            </div>
        </div>
    </form>
@endsection