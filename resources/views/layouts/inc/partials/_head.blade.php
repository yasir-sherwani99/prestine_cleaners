<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @yield('style')
    <?php
        $snippets = \App\Snippet::where([['is_active', 1],['location','header'],['display','site_wide']])->get();
    ?>
    @if (!empty($snippets))
        @foreach($snippets as $snippet)
            {!! $snippet->code !!}
        @endforeach
    @endif
</head>
