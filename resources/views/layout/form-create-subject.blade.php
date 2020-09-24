<form action="{{ route($action, $param ?? '') }}" method="post" class="need-validate was-validated" id="create_subject">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="subject_id">Subject ID</label>
        {!! Form::text('subject_id', $subject->subject_id ?? '', [
        'id' => 'subject_id',
        'class' => 'form-control',
        'required',
        'pattern' => '[a-zA-Z0-9]*',
        isset($subject) ? 'readonly' : '',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="name">Subject Name</label>
        {!! Form::text('name', $subject->name ?? '', [
        'id' => 'name',
        'class' => 'form-control',
        'required',
        'pattern' => '[a-zA-Z0-9 -]*',
        ]) !!}
    </div>
    <div class="form-group">
        <label for="sessions">Number of Sessions</label>
        {!! Form::number('sessions', $subject->sessions ?? '', [
        'id' => 'sessions',
        'class' => 'form-control',
        'min' => 0,
        ]) !!}
    </div>
    <button type="submit" class="btn btn-secondary">Submit</button>
</form>