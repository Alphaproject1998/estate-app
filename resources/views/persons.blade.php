@extends("layout.master")

@section("pageTitle", "Result")
    
@section("styles")
<style>
    nu {
        color:gray;
    }
</style>
@endsection

@section("content")
<!-- All just for show -->
<code>
<strong>{{count($persons)}} Results</strong><br/><br/>
@foreach($persons as $key => $person)
    <strong>{{$key+1}}</strong><br/>
    @foreach($person as $key => $item)
        $person[‘{{$key}}’] => {!! $item ?? "<nu>null</nu>"!!}@if(!$loop->last),@endif
        <br/>
    @endforeach
    <br/>
@endforeach
</code>