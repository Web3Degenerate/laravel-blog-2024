{{-- Copied from create-post (3:50): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426442#overview --}}

<x-layout>

    <div class="container py-md-5 container--narrow">
        <form action="/post/{{ $post->id }}" method="POST">
{{-- (13:40) Add link back to view post: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426442#overview --}}
            <p><small><strong><a href="/post/{{$post->id}}">&laquo; Go back to view this post.</a></strong></small></p>
            @csrf 
{{-- (6:15) use (at)method('PUT'): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426442#overview --}}
            @method('PUT')
        <div class="form-group">
            <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
            {{-- <input required name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" /> --}}
{{-- (5:00)- Use old title unless post title exists: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426442#overview --}}
            <input value="{{ old('title', $post->title) }}" name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
            @error('title')
                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
            @enderror
        </div>
  
          <div class="form-group">
            <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
            {{-- <textarea required name="body" id="post-body" class="body-content tall-textarea form-control" type="text"></textarea> --}}
            <textarea name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{old('body', $post->body)}}</textarea>
            @error('body')
                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
            @enderror
          </div>
  
          <button class="btn btn-primary">Save Changes</button>
        </form>
      </div>

</x-layout>