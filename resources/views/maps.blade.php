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
      const apiKey = "REDACTED";
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
  
    </script>
@endsection
