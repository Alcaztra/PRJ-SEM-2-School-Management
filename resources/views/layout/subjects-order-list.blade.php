@php
$order = 0
@endphp
@for ($i = 1; $i <= 4; $i++)
    <hr>
    <h5>Semester {{ $i }}</h5>
    @isset($sub_sem)
        <ul class="list-group" name="drag_zone">
            @foreach ($sub_sem[$i] as $ss)
                @isset($ss)
                    <li class="list-group-item p-1" id="{{ 'li_' . ++$order }}" data-subject="{{ $ss->subject_id }}">
                        <div class="d-flex align-items-center justify-content-between" id="{{ "drag_$order" }}"
                            name='drag_item'>
                            <span class="mdi mdi-drag mr-1" style="font-size: 20px"></span>
                            <span class="w-100 align-self-center">
                                {{ $ss->subject_id . ' | ' . $ss->name }}
                            </span>
                            <span class="badge badge-pill badge-info">{{ $ss->subject_order }}</span>
                        </div>
                    </li>
                @endisset
            @endforeach
        </ul>
    @endisset
@endfor
