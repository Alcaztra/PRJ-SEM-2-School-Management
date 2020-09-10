<form action="{{ route($action, $params ?? '') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="class_id">Class ID</label>
        {!! Form::text('class_id', $class->class_id ?? '', ['id' => 'class_id', 'class' => 'form-control', isset($class)
        ? 'readonly' : '']) !!}
    </div>
    <div class="form-group">
        <label for="room">Room</label>
        {!! Form::text('room', $class->room ?? '', ['id' => 'room', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="max_size">Max Size</label>
        {!! Form::number('max_size', $class->max_size ?? '', ['id' => 'max_size', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="">Study Shift</label>
        <div class="input-group">
            <select name="DoW" id="" class="custom-select">
                <option value="">- Day of Week -</option>
                <option value="1" {{ isset($class) && $class->DoW == 1 ? 'selected' : '' }}>Tue / Thu / Sat</option>
                <option value="2" {{ isset($class) && $class->DoW == 2 ? 'selected' : '' }}>Mon / Wed / Fri</option>
            </select><select name="period_id" id="" class="custom-select">
                <option value="">- Period -</option>
                <option value="mor" {{ isset($class) && $class->period_id == 'mor' ? 'selected' : '' }}>Morning</option>
                <option value="aft" {{ isset($class) && $class->period_id == 'aft' ? 'selected' : '' }}>Afternoon</option>
                <option value="eve" {{ isset($class) && $class->period_id == 'eve' ? 'selected' : '' }}>Evening</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="start_day">Start Day</label>
        {!! Form::date('start_day', $class->start_day ?? '', ['id' => 'start_day', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="course_id">Course</label>
        <select name="course_id" id="course_id" class="custom-select">
            <option value="">- Select Course -</option>
            @isset($courses)
                @foreach ($courses as $c)
                    @if (isset($class) && $c->course_id == $class->course_id)
                        <option value="{{ $c->course_id }}" selected>{{ $c->course_id . ' - ' . $c->name }}</option>
                    @else
                        <option value="{{ $c->course_id }}">{{ $c->course_id . ' - ' . $c->name }}</option>
                    @endif
                @endforeach
            @endisset
        </select>
    </div>
    <button type="submit" class="btn btn-secondary">Submit</button>
</form>
