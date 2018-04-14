$(document).ready(function(){
	"use strict";

//---------Отправка формы сразу после выбора изображений----------
    $("#imgUpload").change(function(){ // событие выбора файла
      $("#formImgUpload").submit(); // отправка формы
    });


//---------Кастомный скролл бар----------
  $(window).on("load",function(){
    new SimpleBar($('.sideBarImgWrap')[0])
  });

});
