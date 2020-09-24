<form action="{{ route($action, $param ?? '') }}" method="post" class="need-validate">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="user_id">Account</label>
        {!! Form::text('user_id', $user_id ?? '', [
        'id' => 'user_id',
        'class' => 'form-control',
        'pattern' => '[0-9a-zA-Z]*',
        'required' => true,
        'autocomplete' => 'off',
        'placeholder' => 'user id',
        ]) !!}
        <div class="valid-feedback"></div>
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        {!! Form::password('password', [
        'id' => 'password',
        'class' => 'form-control',
        'required',
        'pattern' => '[\w\d]*',
        'minlength' => 6,
        'placeholder' => '*********',
        ]) !!}
    </div>
    {!! Form::submit('Login', ['class' => 'btn btn-outline-primary']) !!}
</form>
<div class="mt-2 btn-group btn-group-toggle d-flex">
    <a class="btn btn-outline-warning {{ request()->getHost() == 'localhost' ? 'active' : '' }}"
        href="http://localhost:8000/login" role="button">ADMIN</a>
    <a class="btn btn-outline-success {{ request()->getHost() == 'teacher.localhost' ? 'active' : '' }}"
        href="http://teacher.localhost:8000/login" role="button">TEACHER</a>
    <a class="btn btn-outline-primary {{ request()->getHost() == 'student.localhost' ? 'active' : '' }}"
        href="http://student.localhost:8000/login" role="button">STUDENT</a>
</div>
