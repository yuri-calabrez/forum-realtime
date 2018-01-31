@extends('layouts.default')

@section('content')
    <div class=container>
        <h3>{{__('Recent threads')}}</h3>
        <threads 
        title="{{__('Threads')}}" 
        thread="{{__('Threads')}}" 
        replies="{{__('Replies')}}"
        open="{{__('Open')}}"
        new-thread="{{__('New thread')}}" 
        thread-title="{{__('Thread title')}}" 
        thread-body="{{__('Thread body')}}"
        send="{{__('Send')}}"
        >
            @include('layouts.default.preloader')
        </threads>
    </div>
@endsection

@section('scripts')
    <script src="/js/threads.js"></script>
@endsection