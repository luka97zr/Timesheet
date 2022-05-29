@props(['week'])
<tr class="">
    @foreach($week as $day)
        <td class="month-table__regular month-table__regular--disabled">
            <div class="month-table__date">
                <span >{{$day}}</span>
                <i></i>
            </div>
            <div class="month-table__hours">
                <a href="./days.html" class=" month-table__day"><span>Hours: </span><span>7.5</span>
                </a>
            </div>
        </td>
    @endforeach
</tr>