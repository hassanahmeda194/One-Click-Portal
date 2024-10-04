<form action="{{ route('Post.Import.DeadLines') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="json_file" id="file">
    <button type="submit">submit</button>
</form>
