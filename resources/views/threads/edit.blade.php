@extends('layouts.default')

@section('content')
    <div class="container">
        <h3>{{$thread->title}}</h3>

        <div class="card grey lighten-4">
            <form action="/threads/{{$thread->id}}" method="POST">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="card-content">
                    <div class="input-field">
                        <input type="text" name="title" placeholder="{{__('Thread title')}}" 
                        value="{{$thread->title}}">
                    </div>
                    <div class="input-field">
                    <textarea name="body" class="materialize-textarea" 
                    placeholder="{{__('Thread body')}}">{{$thread->body}}</textarea>    
                    </div>
                    <button class="btn red accent-2" type="submit">{{__('Send')}}</button>
                </div>
            </form>

            <div class="card-action">
                    <a href="/threads/{{$thread->id}}">{{__('Back')}}</a>
                </div>
        </div>
    </div>
@endsection