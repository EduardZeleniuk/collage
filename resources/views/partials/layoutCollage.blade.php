@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

@if ($layouts)
    @foreach($layouts as $layout)
        <div id="{{ $layout['image'] }}" data-pos="{{ $layout['pos'] }}"
             class="collageContainer @if($layout['image'] != 'layout1') hide @endif">
            <button type="button" class="save-collage btn btn-success">Сохранить</button>

            @forelse($isSavedCollages as $isSavedCollage)
                @if($isSavedCollage['layout_id'] == $layout['id'])
                    <img data-collageid="{{  $isSavedCollage['id'] }}" src="{{ url('storage/images/collage/'. $isSavedCollage['collage'] . '.jpeg') }}" alt="">
                @endif
            @empty
                <img src="{{ url('storage/images/layouts/'. $layout['image'] . '.png') }}" alt="">
            @endforelse


            @if($layout['image'] == 'layout1')
                <div class="overlayLayout">
                    <div class="size-50x50 left"></div>
                    <div class="size-50x50 left"></div>
                    <div class="size-50x50 left"></div>
                    <div class="size-50x50 left"></div>
                </div>
            @elseif($layout['image'] == 'layout2')
                <div class="overlayLayout">
                    <div class="size-50x50 left"></div>
                    <div class="size-50x100 right"></div>
                    <div class="size-50x50 left"></div>
                </div>
            @elseif($layout['image'] == 'layout3')
                <div class="overlayLayout">
                    <div class="size-50x50 left"></div>
                    <div class="size-50x50 left"></div>
                    <div class="size-100x50 left"></div>
                </div>
            @endif

        </div>
    @endforeach

    <div id="myTab" class="layoutsContainer">
        @foreach($layouts as $layout)
            <div class="layoutWrap">
                <a href="{{ $layout['image'] }}"><img class="imgSideBar"
                                                      src="{{ url('storage/images/layouts/'. $layout['image'] . '.png') }}"></a>
            </div>
        @endforeach
    </div>

@endif


