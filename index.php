<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="css/leaflet.css">
  <link rel="stylesheet" href="css/L.Control.Layers.Tree.css">
  <link rel="stylesheet" href="css/qgis2web.css">
  <link rel="stylesheet" href="css/fontawesome-all.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- Other head elements -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    html,
    body {
      width: 100%;
      height: 100%;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    .navbar,
    .footer {
      width: 100%;
    }

    .custom-navbar {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-navbar .nav-link {
      color: #ffffff;
      font-weight: 500;
      transition: color 0.3s;
    }

    .custom-navbar .nav-link:hover {
      color: #ffdd57;
    }

    .custom-footer {
      background-color: #1a1a1a;
      color: #ffffff;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .custom-footer a {
      color: #ffdd57;
      text-decoration: none;
    }

    .custom-footer a:hover {
      color: #ffffff;
    }

    .section-container {
      flex-grow: 1;
      justify-content: center;
      padding: 20px;
      display: none;
      opacity: 0;
      transition: opacity 0.5s ease, transform 0.5s ease;
      transform: translateY(100%);
    }

    .section-container.active {
      display: flex;
      opacity: 1;
      transform: translateY(0);
    }

    .section-container.inactive {
      opacity: 0;
    }

    #map {
      width: 60%;
      height: 100%;
      border-radius: 15px;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    #map:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
    }

    #legend-container {
      width: 15%;
      margin-left: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 10px;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .vector-map-legend__item {
      display: flex;
      align-items: center;
      transition: all 0.3s ease-in-out;
    }

    .vector-map-legend__color {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      transition: all 0.3s ease-in-out;
    }

    .vector-map-legend__item:hover {
      transform: scale(1.1);
    }

    .vector-map-legend__color:hover {
      background-color: #ffdd57;
    }

    .footer {
      background-color: rgba(0, 0, 0, 0.2);
      padding: 3px 0;
      color: white;
    }

    .custom-footer {
      background-color: #808080 !important;
    }

    .table {
      border-collapse: separate;
      border-spacing: 0;
      border: 2px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
    }

    th,
    td {
      padding: 10px 15px;
      border-bottom: 2px solid #ddd;
      border-right: 2px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      border-top-left-radius: 10px;
    }

    td {
      background-color: #fff;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr td:last-child {
      border-right: none;
    }

    .content {
      max-width: 800px;
      width: 100%;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .content:hover {
      transform: scale(1.01);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    h3 {
      margin-top: 0;
    }

    .about-content,
    .mission-content,
    .organizational-structure,
    .bupati-profile {
      margin-bottom: 30px;
    }

    .about-heading,
    .mission-heading,
    .structure-heading,
    .profile-heading {
      margin-bottom: 15px;
    }

    ol {
      padding-left: 20px;
    }
  </style>
  <title>Map Viewer</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../batubara/images/Logo.png" width="40" height="50" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" onclick="showSection('map')">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('about')">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('data')">Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin-login.php">Admin</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Home Section -->
  <div id="map-container" class="section-container active">
    <div class="container text-center" style="max-width: 300px; margin-left: 0" ;>
      <h1 class="mb-0 mb-3 mt-3">Peta Sebaran Penduduk di</h1>
      <p>Kabupaten Batu Bara Tahun 2023</p>
    </div>
    <div id="map" style="background-color: #bbdefb;"></div>
    <div id="legend-container">
      <h6>Population:</h6>
      <ul id="api-legend" class="vector-map-legend"></ul>
    </div>
  </div>

  <!-- About Section -->
  <div id="about-container" class="section-container">
    <div class="breadcrumb">
    </div>
    <section class="content">
      <div class="about-content">
        <div class="about-heading">
          <h3>Visi Kabupaten Batu Bara</h3>
        </div>
        <div class="about-description">
          <p>Mewujudkan Kabupaten Batu Bara yang maju, sejahtera, dan berwawasan lingkungan.</p>
        </div>
      </div>
      <div class="mission-content">
        <div class="mission-heading">
          <h3>Misi Kabupaten Batu Bara</h3>
        </div>
        <div class="mission-list">
          <ol>
            <li>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan.</li>
            <li>Mendorong pertumbuhan ekonomi yang inklusif dan berkelanjutan.</li>
            <li>Melestarikan lingkungan hidup dan menjaga kelestarian alam.</li>
            <li>Meningkatkan pelayanan publik yang efisien dan transparan.</li>
            <li>Membangun infrastruktur yang mendukung pertumbuhan dan kesejahteraan masyarakat.</li>
          </ol>
        </div>
      </div>
      <!-- Organizational Structure -->
      <div class="organizational-structure">
        <div class="structure-heading">
          <h3>Struktur Organisasi Kabupaten Batu Bara</h3>
        </div>
        <div class="structure-description">
          <!-- Add your organizational structure here -->
          <!-- For example: -->
          <img src="../batubara/images/strukturorganisasi.jpg" alt="Organizational Structure" style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>

      </div>
      <!-- Profile Bupati -->
      <div class="bupati-profile">
        <div class="profile-heading">
          <h3>Profil Bupati Kabupaten Batu Bara</h3>
        </div>
        <div class="profile-description" style="display: flex; flex-direction: column; align-items: center;">
          <img src="../batubara/images/user.jpg" alt="profile" style="align-items: center;">
          <p>Nama: Ir. H. Zahir, M.AP</p>
          <p>Tanggal Lahir: 29 Januari 1969</p>
          <p>Pendidikan: S-1 Pertanian UMSU Medan Sumut, 1994</p>
          <p>Pengalaman: Anggota DPRD Provinsi Sumatera Utara, Fraksi PDI Perjuangan, 2014 s/d 2019</p>
        </div>
      </div>
    </section>
  </div>

  <!-- Data Section -->
  <div id="data-container" class="section-container" style="margin-bottom: 20px;">
    <div>
      <h3 style="font-size: 24px; text-align: center;">Data Sebaran Penduduk</h3>
      <table class="data-table" style="width: 100%; border-collapse: collapse;">
        <tr>
          <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: left;">Provinsi</th>
          <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: left;">Kabupaten</th>
          <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: left;">Kode Daerah</th>
          <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: left;">Kecamatan</th>
          <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; text-align: left;">Jumlah</th>
        </tr>
        <?php
        include 'koneksi.php';

        $sql = "SELECT provinsi, kabupaten, kodedagri, kecamatan, jumlah FROM kepadatan";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["provinsi"] . "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["kabupaten"] . "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["kodedagri"] . "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["kecamatan"] . "</td><td style='border: 1px solid #ddd; padding: 8px;'>" . $row["jumlah"] . "</td></tr>";
          }
        } else {
          echo "<tr><td colspan='5' style='border: 1px solid #ddd; padding: 8px; text-align: center;'>0 results</td></tr>";
        }
        $conn->close();
        ?>
      </table>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer bg-light text-center text-lg-start custom-footer">
    <div class="container p-2">
      <div class="row">
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        </div>
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-0 d-flex flex-wrap justify-content-end">Links</h5>
          <ul class="list-unstyled mb-0 d-flex flex-wrap justify-content-end">
            <li class="mr-3" style="margin-right: 10px;">
              <i class="fa-brands fa-instagram" style="font-size: 24px;color:#fff"></i>
            </li>
            <li class="mr-3" style="margin-right: 10px;">
              <i class="fa-brands fa-linkedin" style="font-size: 24px;color:#fff"></i>
            </li>
            <li class="mr-3" style="margin-right: 10px;">
              <i class="fa-brands fa-github" style="font-size: 24px;color:#fff"></i>
            </li>
            <li>
            <li class="mr-3" style="margin-right: 10px;">
              <i class="fa-brands fa-facebook" style="font-size: 24px;color:#fff"></i>
            </li>
          </ul>
        </div>
        <div class="text-center">
          © 2024 Copyright
          <a class="text-light" href="#" id="test">Kabupaten Batu Bara</a>
        </div>

      </div>
    </div>

  </footer>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <script src="js/qgis2web_expressions.js"></script>
  <script src="js/leaflet.js"></script>
  <script src="js/L.Control.Layers.Tree.min.js"></script>
  <script src="js/multi-style-layer.js"></script>
  <script src="js/leaflet-svg-shape-markers.min.js"></script>
  <script src="js/leaflet.rotatedMarker.js"></script>
  <script src="js/leaflet.pattern.js"></script>
  <script src="js/leaflet-hash.js"></script>
  <script src="js/Autolinker.min.js"></script>
  <script src="js/rbush.min.js"></script>
  <script src="js/labelgun.min.js"></script>
  <script src="js/labels.js"></script>
  <script src="data/ADMINISTRASIKECAMATAN_AR_50K_0.php"></script>
  <script src="data/ibadah_1.php"></script>
  <script>
    var map = L.map('map', {
      zoomControl: false,
      maxZoom: 28,
      minZoom: 1
    }).fitBounds([
      [3.0581408830699672, 99.10695466563223],
      [3.476548817419964, 99.88370544750849]
    ]);
    var hash = new L.Hash(map);
    map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
    var autolinker = new Autolinker({
      truncate: {
        length: 30,
        location: 'smart'
      }
    });
    // remove popup's row if "visible-with-data"
    function removeEmptyRowsFromPopupContent(content, feature) {
      var tempDiv = document.createElement('div');
      tempDiv.innerHTML = content;
      var rows = tempDiv.querySelectorAll('tr');
      for (var i = 0; i < rows.length; i++) {
        var td = rows[i].querySelector('td.visible-with-data');
        var key = td ? td.id : '';
        if (td && td.classList.contains('visible-with-data') && feature.properties[key] == null) {
          rows[i].parentNode.removeChild(rows[i]);
        }
      }
      return tempDiv.innerHTML;
    }
    // add class to format popup if it contains media
    function addClassToPopupIfMedia(content, popup) {
      var tempDiv = document.createElement('div');
      tempDiv.innerHTML = content;
      if (tempDiv.querySelector('td img')) {
        popup._contentNode.classList.add('media');
        // Delay to force the redraw
        setTimeout(function() {
          popup.update();
        }, 10);
      } else {
        popup._contentNode.classList.remove('media');
      }
    }
    var zoomControl = L.control.zoom({
      position: 'topleft'
    }).addTo(map);
    var bounds_group = new L.featureGroup([]);

    function setBounds() {}

    function pop_ADMINISTRASIKECAMATAN_AR_50K_0(feature, layer) {
      var popupContent = '<table>\
                    <tr>\
                        <th scope="row">provinsi</th>\
                        <td>' + (feature.properties['provinsi'] !== null ? autolinker.link(feature.properties['provinsi'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">kabupaten</th>\
                        <td>' + (feature.properties['kabupaten'] !== null ? autolinker.link(feature.properties['kabupaten'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">kodedagri</th>\
                        <td>' + (feature.properties['kodedagri'] !== null ? autolinker.link(feature.properties['kodedagri'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Kecamatan</th>\
                        <td>' + (feature.properties['Kecamatan'] !== null ? autolinker.link(feature.properties['Kecamatan'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">Jumlah</th>\
                        <td>' + (feature.properties['Jumlah'] !== null ? autolinker.link(feature.properties['Jumlah'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
      var content = removeEmptyRowsFromPopupContent(popupContent, feature);
      layer.on('popupopen', function(e) {
        addClassToPopupIfMedia(content, e.popup);
      });
      layer.bindPopup(content, {
        maxHeight: 400
      });
    }

    function style_ADMINISTRASIKECAMATAN_AR_50K_0_0(feature) {
      if (feature.properties['Jumlah'] >= 28038.000000 && feature.properties['Jumlah'] <= 53109.000000) {
        return {
          pane: 'pane_ADMINISTRASIKECAMATAN_AR_50K_0',
          opacity: 1,
          color: 'rgba(35,35,35,1.0)',
          dashArray: '',
          lineCap: 'butt',
          lineJoin: 'miter',
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: 'rgba(247,251,255,1.0)',
          interactive: true,
        }
      }
      if (feature.properties['Jumlah'] >= 53109.000000 && feature.properties['Jumlah'] <= 58569.000000) {
        return {
          pane: 'pane_ADMINISTRASIKECAMATAN_AR_50K_0',
          opacity: 1,
          color: 'rgba(35,35,35,1.0)',
          dashArray: '',
          lineCap: 'butt',
          lineJoin: 'miter',
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: 'rgba(200,220,240,1.0)',
          interactive: true,
        }
      }
      if (feature.properties['Jumlah'] >= 58569.000000 && feature.properties['Jumlah'] <= 68210.000000) {
        return {
          pane: 'pane_ADMINISTRASIKECAMATAN_AR_50K_0',
          opacity: 1,
          color: 'rgba(35,35,35,1.0)',
          dashArray: '',
          lineCap: 'butt',
          lineJoin: 'miter',
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: 'rgba(115,178,216,1.0)',
          interactive: true,
        }
      }
      if (feature.properties['Jumlah'] >= 68210.000000 && feature.properties['Jumlah'] <= 68210.000000) {
        return {
          pane: 'pane_ADMINISTRASIKECAMATAN_AR_50K_0',
          opacity: 1,
          color: 'rgba(35,35,35,1.0)',
          dashArray: '',
          lineCap: 'butt',
          lineJoin: 'miter',
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: 'rgba(41,121,185,1.0)',
          interactive: true,
        }
      }
      if (feature.properties['Jumlah'] >= 68210.000000 && feature.properties['Jumlah'] <= 90667.000000) {
        return {
          pane: 'pane_ADMINISTRASIKECAMATAN_AR_50K_0',
          opacity: 1,
          color: 'rgba(35,35,35,1.0)',
          dashArray: '',
          lineCap: 'butt',
          lineJoin: 'miter',
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: 'rgba(8,48,107,1.0)',
          interactive: true,
        }
      }
    }
    map.createPane('pane_ADMINISTRASIKECAMATAN_AR_50K_0');
    map.getPane('pane_ADMINISTRASIKECAMATAN_AR_50K_0').style.zIndex = 400;
    map.getPane('pane_ADMINISTRASIKECAMATAN_AR_50K_0').style['mix-blend-mode'] = 'normal';
    var layer_ADMINISTRASIKECAMATAN_AR_50K_0 = new L.geoJson(json_ADMINISTRASIKECAMATAN_AR_50K_0, {
      attribution: '',
      interactive: true,
      dataVar: 'json_ADMINISTRASIKECAMATAN_AR_50K_0',
      layerName: 'layer_ADMINISTRASIKECAMATAN_AR_50K_0',
      pane: 'pane_ADMINISTRASIKECAMATAN_AR_50K_0',
      onEachFeature: pop_ADMINISTRASIKECAMATAN_AR_50K_0,
      style: style_ADMINISTRASIKECAMATAN_AR_50K_0_0,
    });
    bounds_group.addLayer(layer_ADMINISTRASIKECAMATAN_AR_50K_0);
    map.addLayer(layer_ADMINISTRASIKECAMATAN_AR_50K_0);

    function pop_ibadah_1(feature, layer) {
      var popupContent = '<table>\
                    <tr>\
                        <th scope="row">nama</th>\
                        <td>' + (feature.properties['nama'] !== null ? autolinker.link(feature.properties['nama'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">alamat</th>\
                        <td>' + (feature.properties['alamat'] !== null ? autolinker.link(feature.properties['alamat'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">kategori</th>\
                        <td>' + (feature.properties['kategori'] !== null ? autolinker.link(feature.properties['kategori'].toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">foto</th>\
                        <td>' + (feature.properties['foto'] !== null ? autolinker.link(feature.properties['foto'].toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
      var content = removeEmptyRowsFromPopupContent(popupContent, feature);
      layer.on('popupopen', function(e) {
        addClassToPopupIfMedia(content, e.popup);
      });
      layer.bindPopup(content, {
        maxHeight: 400
      });
    }

    function style_ibadah_1_0(feature) {
      switch (String(feature.properties['kategori'])) {
        case 'Gereja':
          return {
            pane: 'pane_ibadah_1',
              rotationAngle: 0.0,
              rotationOrigin: 'center center',
              icon: L.icon({
                iconUrl: 'markers/gereja.svg',
                iconSize: [18.24, 18.24]
              }),
              interactive: true,
          };
        case 'Masjid':
          return {
            pane: 'pane_ibadah_1',
              rotationAngle: 0.0,
              rotationOrigin: 'center center',
              icon: L.icon({
                iconUrl: 'markers/masjid.svg',
                iconSize: [18.24, 18.24]
              }),
              interactive: true,
          };
      }
    }

    map.createPane('pane_ibadah_1');
    map.getPane('pane_ibadah_1').style.zIndex = 401;
    map.getPane('pane_ibadah_1').style['mix-blend-mode'] = 'normal';

    fetch('data/ibadah_1.php')
      .then(response => response.json())
      .then(data => {
        var layer_ibadah_1 = L.geoJson(data, {
          attribution: '',
          interactive: true,
          layerName: 'layer_ibadah_1',
          pane: 'pane_ibadah_1',
          onEachFeature: pop_ibadah_1,
          pointToLayer: function(feature, latlng) {
            return L.marker(latlng, style_ibadah_1_0(feature));
          },
        });

        bounds_group.addLayer(layer_ibadah_1);
        map.addLayer(layer_ibadah_1);
        setBounds();
      })
      .catch(error => console.error('Error:', error));

    var i = 0;
    layer_ADMINISTRASIKECAMATAN_AR_50K_0.eachLayer(function(layer) {
      var context = {
        feature: layer.feature,
        variables: {}
      };
      layer.bindTooltip((layer.feature.properties['NAMOBJ'] !== null ? String('<div style="color: #000000; font-size: 10pt; font-style: italic; font-family: \'Georgia\', sans-serif;">' + layer.feature.properties['NAMOBJ']) + '</div>' : ''), {
        permanent: true,
        offset: [-0, -16],
        className: 'css_ADMINISTRASIKECAMATAN_AR_50K_0'
      });
      labels.push(layer);
      totalMarkers += 1;
      layer.added = true;
      addLabel(layer, i);
      i++;
    });
    resetLabels([layer_ADMINISTRASIKECAMATAN_AR_50K_0]);
    map.on("zoomend", function() {
      resetLabels([layer_ADMINISTRASIKECAMATAN_AR_50K_0]);
    });
    map.on("layeradd", function() {
      resetLabels([layer_ADMINISTRASIKECAMATAN_AR_50K_0]);
    });
    map.on("layerremove", function() {
      resetLabels([layer_ADMINISTRASIKECAMATAN_AR_50K_0]);
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const map = document.getElementById('-map');
      const legend = document.getElementById('api-legend');

      const colorMap = [{
          fill: '#F7FBFF',
          regions: [],
          min: 0,
          max: 58000
        },
        {
          fill: '#C8DCF0',
          regions: [],
          min: 58000,
          max: 68000
        },
        {
          fill: '#73B2D8',
          regions: [],
          min: 68000,
          max: 780000
        },
        {
          fill: '#08306B',
          regions: [],
          min: 78000,
          max: 90000
        },
      ];

      const generateLegend = (colorMap) => {
        return colorMap
          .map(({
            fill,
            min,
            max
          }) => {
            return `
                    <li class="vector-map-legend__item my-2">
                        <div class="vector-map-legend__color me-2 border" style="background-color: ${fill}"></div>
                        ${min} - ${max}
                    </li>
                    `;
          })
          .join('\n');
      };

      legend.innerHTML = generateLegend(colorMap);

      fetch('https://restcountries.com/v2/all')
        .then((response) => response.json())
        .then((data) => {
          data.forEach((country) => {
            const {
              alpha2Code,
              population,
              capital,
              flag
            } = country;
            const section = colorMap.find((section) => {
              return population >= section.min && population < section.max;
            });
            if (!section) {
              return;
            }
            section.regions.push({
              id: alpha2Code,
              tooltip: `
                            <div>
                                <img src="${flag}" class="my-1" style="max-width: 40px">
                            </div>
                            `,
            });
          });

          // Initialize the map with your colorMap
          const mapInstance = new VectorMap(map, {
            readonly: true,
            strokeWidth: 0.2,
            hover: false,
            fill: 'white',
            colorMap,
          });
        });
    });
  </script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>

  <script>
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.section-container');
      sections.forEach(section => {
        if (section.id === sectionId + '-container') {
          section.classList.add('active');
          section.classList.remove('inactive');
        } else {
          section.classList.remove('active');
          section.classList.add('inactive');
        }
      });
    }
  </script>
</body>

</html>