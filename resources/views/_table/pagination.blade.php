@if($data->lastPage() != 1 || $data ==  null)
    <nav>
        <ul class="pagination">
            <li class="page-item @if($data->previousPageUrl() == null) disabled @endif">
                <a class="page-link" href="{{$data->previousPageUrl()}}">
                    <span aria-hidden="true">←</span> Previous </a>
            </li>
            <li class="page-item @if(!$data->hasMorePages()) disabled @endif">
                <a class="page-link" href="{{$data->nextPageUrl()}}">Next
                    <span aria-hidden="true">→</span></a>
            </li>
        </ul>
    </nav>
@endif