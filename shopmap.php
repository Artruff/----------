<?php
include 'php/config.php';
include 'php/functions.php';

$points = get_shops();
?>
<!DOCTYPE html><html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
  <title>ChinaTown</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="fadein">
      <img src="images/TeaFarm.jpeg">
      <img src="images/CoffeBeans.jpeg">
      <img src="images/TeaField.jpeg">
    </div>
  <header>
    <?php 
    $page = "map";
    include ('php/header.php');
    ?>
  </header>
    <div class="bigcanvas">  
      <div class="content">
      <p class="title_p">Карта магазинов в Новосибирске</p>
      	<div id='map' style="height: 55vh; width: 96%; margin: 2%;"></div>
        	<script>
      			var locations = [["",1000,90000]];
          </script>
            <? foreach($points as $point): ?>
              <script>
                var loc = ['<?=$point['name']?>',<?=$point['yCoordinate']?>, <?=$point['xCoordinate']?>];
                locations.push(loc);
              </script>
            <?php endforeach; ?>
          <script>
            var map = L.map('map').setView([55.0189, 82.9332], 12);
            mapLink = 
                '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 18,
                }).addTo(map);
      			for (var i = 0; i < locations.length; i++) {
      			marker = new L.marker([locations[i][1],locations[i][2]])
              marker.bindPopup(locations[i][0]);
              marker.addTo(map);
      		}
      	</script>
      </div>
    </div>
  <footer>
    <?php include ('php/footer.php');?>
  </footer>
</body>
</html>