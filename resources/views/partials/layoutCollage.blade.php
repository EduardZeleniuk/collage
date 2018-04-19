@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

@if ($layouts)
    @foreach($layouts as $layout)
        <div id="{{ $layout['image'] }}" data-pos="{{ $layout['pos'] }}"
             @if(session()->has('layoutNumb'))
                class="collageContainer @if($layout['image'] != session()->get('layoutNumb') ) hide @endif">
            @else
                class="collageContainer @if($layout['image'] != 'layout1' ) hide @endif">
            @endif
            @if($isSavedCollages)
                @foreach($isSavedCollages as $isSavedCollage)
                    @if($isSavedCollage['layout_id'] == $layout['id'])
                        <button type="button" class="save-collage btn btn-success btn-sm">Сохранить</button>
                        <button type="button" class="delete-collage btn btn-danger btn-sm">Начать с начала</button>
                    @endif
                @endforeach
            @endif

            <?php $collageFlag = 0; ?>

            @if($isSavedCollages)
                @foreach($isSavedCollages as $isSavedCollage)
                    @if($isSavedCollage['layout_id'] == $layout['id'])
                        <?php $collageFlag = 1; ?>
                        <a href="{{ url('storage/images/collage/'. $isSavedCollage['collage'] . '.jpeg') }}" data-fancybox="{{ $layout['image'] }}">
                            <img data-collageid="{{  $isSavedCollage['id'] }}" src="{{ url('storage/images/collage/'. $isSavedCollage['collage'] . '.jpeg') }}" alt="">
                        </a>
                    @endif
                @endforeach
                @if($collageFlag == 0)
                    <a href="{{ url('storage/images/layouts/'. $layout['image'] . '.png') }}" data-fancybox="{{ $layout['image'] }}">
                        <img src="{{ url('storage/images/layouts/'. $layout['image'] . '.png') }}" alt="">
                    </a>
                @endif
            @else
                <a href="{{ url('storage/images/layouts/'. $layout['image'] . '.png') }}" data-fancybox="{{ $layout['image'] }}">
                    <img src="{{ url('storage/images/layouts/'. $layout['image'] . '.png') }}" alt="">
                </a>
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


