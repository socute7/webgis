<?php
include_once '../koneksi.php';

$sql = "SELECT * FROM lokasi WHERE lng > 0";
$hasil = mysqli_query($conn, $sql);

$features = [];
while ($data = mysqli_fetch_assoc($hasil)) {
  $id = $data['id'];
  $nama = $data['nama'];
  $alamat = $data['alamat'];
  $lat = $data['lat'];
  $lng = $data['lng'];
  $kategori = $data['kategori'];
  $foto = $data['foto'];

  $feature = [
    'type' => 'Feature',
    'properties' => [
      'id' => $id,
      'nama' => $nama,
      'alamat' => $alamat,
      'lat' => $lat,
      'lng' => $lng,
      'kategori' => $kategori,
      'foto' => $foto
    ],
    'geometry' => [
      'type' => 'Point',
      'coordinates' => [$lng, $lat]
    ]
  ];

  array_push($features, $feature);
}

$featureCollection = [
  'type' => 'FeatureCollection',
  'name' => 'ibadah_1',
  'crs' => [
    'type' => 'name',
    'properties' => [
      'name' => 'urn:ogc:def:crs:OGC:1.3:CRS84'
    ]
  ],
  'features' => $features
];

header('Content-Type: application/json');
echo json_encode($featureCollection);
