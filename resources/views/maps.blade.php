@extends('_voler.master')

@section('content')
<link href="https://unpkg.com/maplibre-gl@3.x/dist/maplibre-gl.css" rel="stylesheet" />
<style>
  body { margin: 0; }
  #map { height: 100vh; }
</style>
<div id="map" />
    <script src="https://unpkg.com/maplibre-gl@3.x/dist/maplibre-gl.js"></script>
    <script>
      const apiKey = "v1.public.eyJqdGkiOiJmODVlNzExZC03MWE3LTQ3OTAtYWZjZC02ODBiOGM4OWMyMDYifZFF0YWJCtRWl0RrmK_4rEYz6RInVI3fmIXdAaleFg9o9pbDhc7A7VZ9VA-En-de2_zXaYIuup-b5a9EpTdbf-BjCSlN7yF8Bla8P2Gi-GqEQgokj9zLRDFJqYyDpqQM-xbL0ywbDL9i2pvB0uJeVmwKyce33xHDowN3GND2R9Ir1at4QRcuUMYBpljIUMTeH7pZXqgySRRQJYSK8gZ_gSZIPJGsAbTrXtZBaeeCTyaneCVCTnlGO914VbHrcH2td7LMYSl9MVggr-2Mawun6MRbrlsJ-p5ebCPXzoTaiEC963lHH4XRTx9-HENIFRIzIJrwCMHNrQMlwoDDX3Uec3M.ZWU0ZWIzMTktMWRhNi00Mzg0LTllMzYtNzlmMDU3MjRmYTkx";
      const mapName = "sisfo_tatakelolapedagang";
      const region = "us-east-1";

      const map = new maplibregl.Map({
        container: "map",
        style: `https://maps.geo.${region}.amazonaws.com/maps/v0/maps/${mapName}/style-descriptor?key=${apiKey}`,
        // center: [-123.115898, 49.295868],
        center: [109.651783, -7.668779],
        zoom: 17,
      });
      map.addControl(new maplibregl.NavigationControl(), "top-left");
      const coordinates = [
    [109.651284, -7.669550],
    [109.650978, -7.669111],
    [109.651028, -7.668332],
    [109.651436, -7.667990],
    [109.652313, -7.667945],
    [109.652619, -7.668279],
    [109.652631, -7.668887],
    [109.652264, -7.669489],
  ];

  coordinates.forEach(coord => {
    new maplibregl.Marker()
      .setLngLat(coord)
      .addTo(map);
  });
  
    </script>
@endsection
