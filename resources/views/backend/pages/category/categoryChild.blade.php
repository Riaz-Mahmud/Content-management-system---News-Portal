
@if (isset($category))
    @foreach ($category->child as $child)
        @if ($child->haveChild)
            <option value="{{$child->hashId}}" class="nested-option" @if( $selected == $child->id ) selected @endif>
                @php
                    $i = 0;
                    while ($i < $level) {
                        echo '-';
                        $i++;
                    }
                @endphp
                {{$child->title}}
            </option>
            @include('backend.pages.category.categoryChild', ['category' => $child, 'level' => $level + 1, 'selected' => $selected])
        @else
            <option value="{{$child->hashId}}">
                @php
                    $i = 0;
                    while ($i < $level) {
                        echo '-';
                        $i++;
                    }
                @endphp
                {{$child->title}}
            </option>
        @endif
    @endforeach

@endif
