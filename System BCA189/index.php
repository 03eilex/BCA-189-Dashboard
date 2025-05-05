<!DOCTYPE html>
<html>
<head>
  <title>Soil Sensor Data</title>
  <link rel="stylesheet" href="indexstyle.css">
  <script defer src="indexjava.js"></script>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="profile">
    <img src="soil.png" alt="Profile Picture" />
    <p class="username">John Doe</p>
  </div>
  <ul>
    <li><a href="index.php">Dashboard</a></li>
    <li><a href="analytics.php">Analytics</a></li>
    <li><a href="settings.php">Settings</a></li>
    <li><a href="help.php">Help</a></li>
  </ul>
</div>

<!-- Top Bar -->
<div class="topbar">
  <div class="topbar-left">
    <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰</button>
    <a href="index.php" class="page-title">Dashboard</a>
  </div>
  <div class="search-container">
    <input type="text" placeholder="Search..." />
  </div>
</div>

<!-- Main Content -->
<div class="container" id="mainContent">
  <h2 class="section-title">Soil Sensor Readings</h2>

  <div class="data-cards">
    <?php
      $temp = $_GET['temp'] ?? 'N/A';
      $hum = $_GET['hum'] ?? 'N/A';
      $ec = $_GET['ec'] ?? 'N/A';
      $moisture = $_GET['moisture'] ?? 'N/A';
      $ph = $_GET['ph'] ?? 'N/A';
      $n = $_GET['n'] ?? 'N/A';
      $p = $_GET['p'] ?? 'N/A';
      $k = $_GET['k'] ?? 'N/A';

      function getSoilType($moisture, $ph, $n, $p, $k) {
        if ($moisture === 'N/A' || $ph === 'N/A' || $n === 'N/A' || $p === 'N/A' || $k === 'N/A') {
          return ['Unknown', 'Insufficient data to determine soil type.'];
        }

        if ($ph >= 6 && $ph <= 7.5 && $moisture >= 30 && $moisture <= 50 && $n >= 20 && $p >= 15 && $k >= 15) {
          return ['Loam', 'Loam soil is ideal for most crops with good water retention and drainage.'];
        } elseif ($moisture < 20 && $ph < 6) {
          return ['Sandy', 'Sandy soil drains quickly and is low in nutrients. Suitable for drought-resistant plants.'];
        } elseif ($moisture > 60 && $ph < 6.5) {
          return ['Clay', 'Clay soil holds water well but may have drainage issues. Best for rice and wet crops.'];
        } else {
          return ['Unknown', 'The soil properties do not match a known classification. Consider further testing.'];
        }
      }

      $moistureVal = is_numeric($moisture) ? floatval($moisture) : 'N/A';
      $phVal = is_numeric($ph) ? floatval($ph) : 'N/A';
      $nVal = is_numeric($n) ? floatval($n) : 'N/A';
      $pVal = is_numeric($p) ? floatval($p) : 'N/A';
      $kVal = is_numeric($k) ? floatval($k) : 'N/A';

      list($soilType, $description) = getSoilType($moistureVal, $phVal, $nVal, $pVal, $kVal);
      $descClass = ($soilType === 'Unknown') ? 'unknown-desc' : 'known-desc';

      echo "<div class='card wide-card'>
              <h3>Soil Type: {$soilType}</h3>
              <p class='{$descClass}'>{$description}</p>
            </div>";

      echo "<div class='card medium-card data-card'>
              <div class='card-content'>
                <div>
                  <h4>Temperature</h4>
                  <p>{$temp} °C</p>
                </div>
                <img src='thermometer.png' alt='Temperature' class='card-img' />
              </div>
            </div>";

      echo "<div class='card small-card data-card'>
              <div class='card-content'>
                <div>
                  <h4>Humidity</h4>
                  <p>{$hum} %</p>
                </div>
                <img src='humidity.png' alt='Humidity' class='card-img' />
              </div>
            </div>";

      echo "<div class='card small-card data-card'>
              <div class='card-content'>
                <div>
                  <h4>Moisture</h4>
                  <p>{$moisture}</p>
                </div>
                <img src='pure-water.png' alt='Moisture' class='card-img' />
              </div>
            </div>";

     echo "<div class='card small-card data-card'>
            <div class='card-content'>
              <div>
                <h4>pH</h4>
                <p>{$ph}</p>
              </div>
              <img src='ph-balance.png' alt='pH' class='card-img' />
            </div>
          </div>";            

    echo "<div class='card medium-card data-card'>
            <div class='card-content'>
              <div>
                <h4>Electrical Conductivity</h4>
                <p>{$ec}</p>
              </div>
              <img src='flash.png' alt='EC' class='card-img' />
            </div>
          </div>";

      echo "<div class='npk-group'>
              <div class='card npk-card data-card'>
                <div class='card-content'>
                  <div>
                    <h4>N (Nitrogen)</h4>
                    <p>{$n} ppm</p>
                  </div>
                  <img src='nitrogen.png' alt='Nitrogen' class='card-img' />
                </div>
              </div>
              <div class='card npk-card data-card'>
                <div class='card-content'>
                  <div>
                    <h4>P (Phosphorus)</h4>
                    <p>{$p} ppm</p>
                  </div>
                  <img src='crops-nourishment.png' alt='Phosphorus' class='card-img' />
                </div>
              </div>
              <div class='card npk-card data-card'>
                <div class='card-content'>
                  <div>
                    <h4>K (Potassium)</h4>
                    <p>{$k} ppm</p>
                  </div>
                  <img src='soil-supplement.png' alt='Potassium' class='card-img' />
                </div>
              </div>
            </div>";
    ?>
  </div>
</div>

</body>
</html>
