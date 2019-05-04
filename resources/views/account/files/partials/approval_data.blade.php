<article class="message is-link">
    <div class="message-body">
        <p><strong>Folloving changes are waiting for approval:</strong></p>
        <br>
        <ul>
            @foreach($approval->approvalFields() as $field => $value)
                <strong>{{ str_replace('_', ' ', ucfirst($field)) }}</strong>
                <p>{{ $value }}</p>
                <br>
            @endforeach
        </ul>
    </div>
</article>