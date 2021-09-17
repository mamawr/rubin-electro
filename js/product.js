document.addEventListener("DOMContentLoaded", function(event) {

  // Заполняем гелерею тумбами изображения продукта

  var galery = document.querySelector('.gallery');
  product_images.forEach(function (img, index, arr) {
    var item = document.createElement("img");
    item.src = img.thumb;
    item.dataset.index = index;
    item.addEventListener("click", onGalleryImageClick);
    galery.appendChild(item);
  });

  // Обработчик клика по выбранному изображению продукта

  var product_img = document.querySelector('.photo img');
  product_img.src = product_images[0].thumb;
  product_img.dataset.index = 0;
  product_img.addEventListener("click", onProductImageClick);

});

///////////////////////////////////////////////////////////////////////
function onProductImageClick(event) {
  Fancybox.show(product_images, {
     Thumbs: {},
     startIndex: event.currentTarget.dataset.index,
    on: {
      "init": function (event, fancybox, slide) {
        history.pushState(undefined, undefined, '#photo');
      },
      "destroy": function (event, fancybox, slide) {
      },
    },
  });
}

///////////////////////////////////////////////////////////////////////
function onGalleryImageClick(event) {
  var product_img = document.querySelector('.photo img');
  product_img.src = product_images[event.currentTarget.dataset.index].thumb;
  product_img.dataset.index = event.currentTarget.dataset.index;
}
