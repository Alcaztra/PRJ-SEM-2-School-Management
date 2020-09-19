<form action="{{ route($action, $param ?? '') }}" method="post" id="create_course_form">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="course_id">Course ID</label>
        {!! Form::text('course_id', $course->course_id ?? '', ['id' => 'course_id', 'class' => 'form-control',
        isset($course) ? 'readonly' : '']) !!}
    </div>
    <div class="form-group">
        <label for="name">Course Name</label>
        {!! Form::text('name', $course->name ?? '', ['id' => 'name', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="">Semester</label>
        <div class="input-group pb-2">
            <select class="custom-select col-md-4" id="sem_opt">
                <option value="">- Select semester -</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
            </select>
            <select class="custom-select" id="sub_opt">
                <option value="">- Select subject -</option>
                @isset($subjects)
                    @foreach ($subjects as $s)
                        <option value="{{ $s->subject_id }}">{{ $s->name }}</option>
                    @endforeach
                @endisset
            </select>
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-primary" onclick="insertSubject()">Add</button>
            </div>
        </div>
        <div class="col" id="data_table">
            @for ($i = 1; $i <= 4; $i++)
                <div class="row ">
                    <div class="p-1 border" style="width: 150px">Semester {{ $i }}</div>
                    <div class="p-1 border" id="sem_{{ $i }}">
                        @isset($sub_sem)
                            @foreach ($sub_sem[$i] as $ss)
                                @isset($ss)
                                    <p role='button' class="btn btn-outline-primary p-2 m-1 text-uppercase cursor-pointer"
                                        data-label='addItem' data-id='{{ $ss->subject_id }}' data-toggle='tooltip'
                                        title="{{ $ss->name }}"
                                        onclick="removeSubject( this,'{{ $ss->subject_id }}', {{ $i }} )">
                                        {{ $ss->subject_id }}<span class='mx-1'>&times;</span></p>
                                    <input type='hidden' readonly name='{{ 'semester_' . $i . '[]' }}' data-sem="{{ $i }}"
                                        value='{{ $ss->subject_id }}'>
                                @endisset
                            @endforeach
                        @endisset
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <button type="button" class="btn btn-secondary" onclick="checkValid()">Submit</button>
</form>
