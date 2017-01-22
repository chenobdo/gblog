@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong>
        你的输入有些小问题。。<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif