<form action="{{ route($action, $param ?? '') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="subject_id">Subject ID</label>
        {!! Form::text('subject_id', $subject->subject_id ?? '', ['id' => 'subject_id', 'class' => 'form-control',
        isset($subject) ? 'readonly' : '']) !!}
    </div>
    <div class="form-group">
        <label for="name">Subject Name</label>
        {!! Form::text('name', $subject->name ?? '', ['id' => 'name', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="nos">Number of Sessions</label>
        {!! Form::number('NoS', $subject->NoS ?? '', ['id' => 'nos', 'class' => 'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-secondary">Submit</button>
</form>
