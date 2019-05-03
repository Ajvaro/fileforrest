@if(session()->has('success'))
<article class="message is-success">
    <div class="message-body">
        {{ session('success') }}
    </div>
</article>
@endif

@if(session()->has('error'))
    <article class="message is-danger">
        <div class="message-body">
            {{ session('error') }}
        </div>
    </article>
@endif