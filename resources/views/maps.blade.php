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
      // const coordinates = [
      //   [109.651284, -7.669550],
      //   [109.650978, -7.669111],
      //   [109.651028, -7.668332],
      //   [109.651436, -7.667990],
      //   [109.652313, -7.667945],
      //   [109.652619, -7.668279],
      //   [109.652631, -7.668887],
      //   [109.652264, -7.669489],
      // ];

    fetch('/api/locations')
    .then(response => response.json())
    .then(data => {
      data.forEach(location => {
        const marker = new maplibregl.Marker()
          .setLngLat([location.long, location.lat])
          .addTo(map);

        const popup = new maplibregl.Popup({ offset: 25 })
          .setHTML(`<h3>${location.locationCode}</h3><p>${location.status}</p>`);
        
        marker.setPopup(popup);
      });
    })
    .catch(error => console.error('Error fetching locations:', error));
</script>
    </script>
@endsection
