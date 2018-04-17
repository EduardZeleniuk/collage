$(document).ready(function () {
  "use strict";

//---------Отправка формы сразу после выбора изображений----------
  $("#imgUpload").change(function () { // событие выбора файла
    $("#formImgUpload").submit(); // отправка формы
  });


//---------Кастомный скролл бар----------
  function customScroll() {
    $(window).on("load", function () {
      new SimpleBar($('.sideBarImgWrap')[0]);
      new SimpleBar($('.sideBarImgWrap')[1]);
    });
  }


//---------createCollageBtn--------------
  function createCollageBtn() {
    var layout = $('.collageContainer').not('.collageContainer.hide').data('pos'),
      content = '';

    for (var i = 1; i <= layout; i++) {
      content += '<label class="btn btn-secondary"><input type="checkbox" name="position" value="' + i + '" autocomplete="off">' + i + '</label>'
    }
    $('.btn-group-toggle').html(content);
  }


//-----------Tabs------------------
  function tabs() {
    $('.layoutsContainer a').on('click', function (e) {
      e.preventDefault();
      var id = $(this).attr('href');

      $('.collageContainer').addClass('hide');
      $('.collageContainer').each(function () {
        if ($(this).attr('id') == id) {
          $(this).removeClass('hide');
        }
      });

      createCollageBtn();
      collageBtn();
    });
  }

//------------collageBtn--------------------
  function collageBtn() {
    $('.imgWrap input').on('change', function () {
      var position = $(this).attr('value'),
        img = $(this).closest('.imgWrap').find('.imgSideBar').data('image'),
        layout = $('.collageContainer').not('.collageContainer.hide').attr('id'),
        data = img + '/' + layout + '/' + position;

      document.location.href = 'create/' + data;
    });

  }

  //-----------collageSave---------------
  function collageSave() {
    $('.save-collage').on('click', function() {
       var collageId = $(this).closest('.collageContainer').find('img').data('collageid');
       if(collageId)
          document.location.href = 'collage-save/' + collageId;
       else
         alert('Выберите фото');

    });
  }

  //-----------collageDelete---------------
  function collageDelete() {
    $('.delete-collage').on('click', function() {
      var collageId = $(this).closest('.collageContainer').find('img').data('collageid');
      if(collageId)
        document.location.href = 'collage-delete/' + collageId;
    });
  }

  setTimeout(function(){
    $('.alert.alert-success').fadeOut();
  }, 1500);

  createCollageBtn();
  customScroll();
  tabs();
  collageBtn();
  collageSave();
  collageDelete();
});
