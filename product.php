<?php

  require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_core.php');
  $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '0';
  if (!($product = getProductById($id)))
    response404NotFound();

?>
<!doctype html>
<html lang="ru-RU">
<head>
  <title><?php print($product['name']); ?></title>
  <meta name="description" content="Аккумуляторы и батарейки Рубин. Официальный сайт." />

  <?php include('_meta.php'); ?>

  <script src="/lib/fancybox/fancybox.min.js"></script>
  <link rel="stylesheet" href="/lib/fancybox/fancybox.min.css" media="all" />

  <link rel="stylesheet" href="/css/product.css" media="all" />
  <script src="/js/product.js"></script>

</head>
<body>

  <script>
    var product_images = [
<?php
  foreach($product['images'] as $img) {
    echo <<<IMG
      {
        src: "{$img['media']}",
        thumb: "{$img['thumb']}",
      },
IMG;
  }
?>
    ];
  </script>

  <?php include('_header.php'); ?>

  <div class="wrapper content">

    <div class="product">
      <div class="header">
        <ul class="breadcrumbs">
          <li><a href="/goods/">Продукция</a></li>
<?php
  foreach($product['breadcrumbs'] as $crumb) {
    echo <<<CRUMB
          <li><a href="{$crumb['link']}">{$crumb['name']}</a></li>
CRUMB;
  }
?>
        </ul>

        <h1>Рубин AA-USB</h1>

        <div class="rating">
          <div class="stars">
<?php
  for ($i=1; $i<=$product['rating']; $i++)
    print('            <span class="material-icons-outlined star">star_purple500</span>');
  if ($product['rating'] != (int)$product['rating']) {
    print('            <span class="material-icons-outlined star">star_half</span>');
    $i++;
  }
  for ($j=$i; $j<6; $j++)
    print('            <span class="material-icons-outlined star">star_border_purple500</span>');
?>
            <span class="star-rating"><?php printf('%.1f', $product['rating']); ?> (<?php echo count($product['reviews']) ?>)</span>
          </div>
          <a class="reviews" href="#">Отзывы: <?php echo count($product['reviews']) ?></a>
        </div>
      </div>
      <div class="description">

        <table>
<?php
  foreach($product['spec'] as $item) {
    echo <<<SPEC
          <tr>
            <td>{$item['name']}</td>
            <td>{$item['value']}</td>
          </tr>
SPEC;
  }
?>
        </table>

      </div>
      <div class="summary">
        <div class="photoset">
          <div class="photo">
             <img />   <!-- Этот элемент будет заполнен из js -->
          </div>
          <div class="gallery">
            <!-- Элементы img будут добавлены из js -->
          </div>
          <div class="gal2">
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include('_footer.php'); ?>
</body>
</html>