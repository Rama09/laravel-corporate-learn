@extends(env('THEME').'.layouts.site')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('slider')
    {!! $slider !!}
@endsection

@section('content')
    {!! $content !!}
@endsection