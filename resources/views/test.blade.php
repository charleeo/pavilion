<form action="/api/client" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name">
    <input type="file" name="file">
    <button>Submit</button>
</form>