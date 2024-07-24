@if(isset($results))
@if($results->count())
        <table id="option" style="color:{{$design->searchres_font_color}}; background:{{$design->searchres_color}}; border-color:{{$design->searchres_border_color}}; font-size:{{$design->searchres_font_size}};">
        <thead>
        <tr>
            <th style="border-right-color: {{$design->searchres_border_color}}; border-bottom-color:{{$design->searchres_border_color}};">Песня</th>
            <th style="border-bottom-color:{{$design->searchres_border_color}};">Исполнитель</th>
        </tr>
        </thead>
        <tbody id="result-list">
        @foreach($results as $result)
            <tr>
                <td style="border-right-color: {{$design->searchres_border_color}};">{{$result->title}}</td>
                <td>{{$result->singer}}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    <div id="pagination" class="pagination" style="color:{{$design->pagination_color}};">
        {{ $results->links() }}
    </div>
@else
    <p>No results found</p>
@endif
@endif
