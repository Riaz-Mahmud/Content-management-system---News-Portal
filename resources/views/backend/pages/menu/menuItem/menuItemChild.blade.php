
@if (isset($menuitem))
    @foreach ($menuitem->child as $child)
        @if ($child->haveChild)
            <option value="{{$child->hashId}}" class="nested-option" @if( $selected == $child->id ) selected @endif>
                @php
                    $i = 0;
                    while ($i < $level) {
                        echo '-';
                        $i++;
                    }
                @endphp
                {{$child->label}}
            </option>
            @include('backend.pages.menu.menuItem.menuItemChild', ['menuitem' => $child, 'level' => $level + 1, 'selected' => $selected])
        @else
            <option value="{{$child->hashId}}">
                @php
                    $i = 0;
                    while ($i < $level) {
                        echo '-';
                        $i++;
                    }
                @endphp
                {{$child->label}}
            </option>
        @endif
    @endforeach

@endif
