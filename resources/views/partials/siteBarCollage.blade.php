<div class="side-bar">
    @if ($collages)
        <a href="download" class="btn btn-outline-success btn-block mb-1 fa fa-cloud-download"> Скачать</a>
        <a href="{{ url('collage-delete-all') }}" class="btn btn-outline-primary btn-block mb-3 fa fa-trash"> Очистить</a>
        <div class="sideBarImgWrap">

        @foreach($collages as $collage)
                <div class="imgWrap">
                    <button type="button" class="close" aria-label="Close">
                        <a href="{{ url('collage-delete/'.$collage['id']) }}" class="fa fa-trash"></a>
                    </button>
                    <a href="{{ url('storage/images/collage/'. $collage['collage']).'.jpeg' }}" data-fancybox="collages">
                        <img class="imgSideBar" data-image="{{ $collage['collage'] }}" src="{{ url('storage/images/collage/'. $collage['collage']).'.jpeg' }}">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>