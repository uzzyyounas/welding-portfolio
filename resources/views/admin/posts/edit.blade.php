@extends('layouts.admin')
@section('title', 'Edit Post: ' . $post->title)
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@include('admin.posts.create')
