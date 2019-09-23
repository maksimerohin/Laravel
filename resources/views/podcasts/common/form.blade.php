<div class="columns">
    <div class="column">

        {{ Form::bulmaText('name', 'podcast.name', ['required']) }}
        {{ Form::bulmaTextarea('description', 'podcast.description') }}
        {{ Form::bulmaText('author', 'podcast.author') }}
        {{ Form::bulmaText('copyright', 'podcast.copyright') }}
        {{ Form::bulmaText('keywords', 'podcast.keywords') }}
        {{ Form::bulmaText('website', 'podcast.website') }}
        {{ Form::bulmaText('episode_name_template', 'podcast.episode_name_template') }}
        {{ Form::bulmaTextarea('shownotes_footer', 'podcast.shownotes_footer') }}

    </div>
    <div class="column">
        @include('components.cover', ['url' => $podcast->coverUrl(), 'size' => 300])
        <div class="has-text-grey is-size-7">@lang('common.cover_recomendations')</div>
        {{ Form::bulmaFile('cover', 'common.cover_upload') }}
    </div>
</div>
