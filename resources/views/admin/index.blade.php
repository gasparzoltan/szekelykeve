@extends('admin/main')

@section('content')
  @component('admin/_components/content_header')
    @slot('title')
      Admin Kezdőlap
    @endslot
    @slot('subtitle')
      Vezérlőpult
    @endslot
    <hr>

  @endcomponent

    
    <section class="content">    
      @include('admin/_includes/small_boxes')
    </section>

    
@endsection
    
