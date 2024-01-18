{{-- Added (4:10): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34470392#overview --}}

<x-layout>
    <div class="container container-narrow py-md">

        <h2 class="text-center mb-3"><i>SKIPPED THIS SECTION</i> => Upload a new Avatar</h2>
        
            {{-- <form action="/manage-avatar" method="POST"> --}}
            <form action="/#" method="POST">
                @csrf
                    <div class="mb-3">
                        <input type="file" name="avatar" required>
                        @error('avatar')
                            <p class="alert small alert-danger shadow-sm">{{ $message ?? 'skipped section' }}</p>
                        @enderror
                    </div>
                    
                    <button class="btn btn-primary">Save</button>
            </form>
    </div>
</x-layout>