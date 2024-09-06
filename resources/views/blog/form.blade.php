<form action="" method="POST" class="vstack gap-2 mt-2">
    @csrf
    @method($post->id ? "PATCH" : "POST")
    <div class="form-group">
        <label for="tiltle">Titre</label>
        <input type="text" name="title"  class="form-control" value="{{ old('title', $post->title) }}">
        @error("title")
            {{ $message }}
        @enderror
    </div>

    <div  class="form-group">
        <label for="slug">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}">
        @error("slug")
            {{ $message }}
        @enderror
    </div>

    <div  class="form-group">
        <label for="content">Contenu</label>
        <textarea name="content" class="form-control">{{old('content', $post->content)}}</textarea>
        @error("content")
        {{ $message }}
    @enderror
    </div>
    
    <button class="btn btn-primary">
        @if($post->id) 
            Modifier
        @else
            Créer
        @endif
    
    </button>

</form>