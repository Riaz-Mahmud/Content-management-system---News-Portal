
@if (isset($category))
    @foreach ($category->child as $child)
        @if ($child->haveChild)
            <a href="#" class="list-group-item list-group-item-action" data-href="{{$child->slug}}">
                @php
                    $i = 0;
                    while ($i < $level) {
                        echo '-';
                        $i++;
                    }
                @endphp
                {{$child->title}}
            </a>
            @include('backend.pages.menu.menuItem.categoryChild', ['category' => $child, 'level' => $level + 1, 'selected' => $selected])
        @else
            <a href="#" class="list-group-item list-group-item-action" data-href="{{$child->slug}}">
                @php
                    $i = 0;
                    while ($i < $level) {
                        echo '-';
                        $i++;
                    }
                @endphp
                {{$child->title}}
            </a>
        @endif
    @endforeach

@endif
