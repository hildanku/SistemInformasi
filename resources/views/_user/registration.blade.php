@extends('_voler.master')

@section('content')
<link href="https://unpkg.com/maplibre-gl@3.x/dist/maplibre-gl.css" rel="stylesheet" />
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registration Application</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-danger">please complete the form below</div>
                <div class="row">
                    {{-- <form action="" method="post"> --}}
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="basicInput">Nama Bisnis</label>
                                <input type="text" class="form-control" name="businessName" placeholder="Nama Bisnis, cth: Sop Batu HighClass Edition">
                            </div>

                            <div class="form-group">
                                <label for="helpInputTop">Nama Pemilik Bisnis</label>
                                {{-- <small class="text-muted">eg.<i>someone@example.com</i></small> --}}
                                <input type="text" class="form-control" name="ownerFullName" placeholder="Nama Pemilik, cth: Hildan K. Utomo">
                            </div>

                            <div class="form-group">
                                <label for="helperText">Nomor Telepon Pemilik</label>
                                <input type="text" class="form-control" name="ownerPhoneNumber" placeholder="Nomor Telepon Pemilik, cth: 083124062506">
                                {{-- <p><small class="text-muted">Find helper text here for given textbox.</small></p> --}}
                            </div>

                            <div class="form-group">
                                <label for="helperText">Alamat Pemilik</label>
                                <input type="text" id="helperText" class="form-control" name="ownerAddress" placeholder="Alamat Pemilik, cth: RT 006/001 Ds. ABCD Kec. XYZ Kab. XYZ">
                                {{-- <p><small class="text-muted">Find helper text here for given textbox.</small></p> --}}
                            </div>
                            <div class="form-group">
                                <label for="location">Lokasi</label>
                                <select class="form-control" id="location"></select>
                                {{-- <input type="text" id="locationCode" class="form-control" placeholder="Lokasi"> --}}
                              </div>

                        </div>
                        <div class="col-md-6">
                            <div id="map" style="height: 400px;"></div>
                        </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/maplibre-gl@3.x/dist/maplibre-gl.js"></script>
    <script>
        $(document).ready(function() {
            // init map
            const apiKey = "REDACTED";
            const mapName = "sisfo_tatakelolapedagang";
            const region = "us-east-1";
    
            // create map
            const map = new maplibregl.Map({
                container: "map",
                style: `https://maps.geo.${region}.amazonaws.com/maps/v0/maps/${mapName}/style-descriptor?key=${apiKey}`,
                center: [109.651783, -7.668779],
                zoom: 17,
            });
    
            // add control zoom in zoom out and callibration
            map.addControl(new maplibregl.NavigationControl(), "top-left");
    
            let marker;
            
            // hit api api/available-location to get available location data
            $.ajax({
                url: '/api/available-locations',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var optionsHtml = '';
                    $.each(response, function(index, location) {
                        optionsHtml += '<option value="' + location.id + '">' + location.locationCode + '</option>';
                    });
                    // push to class #location
                    $('#location').html(optionsHtml);
                }
            });
    
            // when location is clicked added marker
            $('#location').change(function() {
                const locationId = $(this).val();
                $.ajax({
                    url: '/api/available-locations',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const selectedLocation = response.find(location => location.id == locationId);
                        if (selectedLocation) {
                            console.log("Selected Location: ", selectedLocation);
                            if (marker) {
                                marker.remove();
                            }
                            // add marker
                            marker = new maplibregl.Marker()
                                .setLngLat([parseFloat(selectedLocation.long), parseFloat(selectedLocation.lat)])
                                .addTo(map);
                            //add popup
                            const popup = new maplibregl.Popup({ offset: 25 })
                                .setHTML(`<h3>${selectedLocation.locationCode}</h3><p>${selectedLocation.status}</p>`);
                            
                            marker.setPopup(popup);
                            // fly to is to fly from area a to area selected
                            map.flyTo({ center: [parseFloat(selectedLocation.long), parseFloat(selectedLocation.lat)], zoom: 17 });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching locations: ", error);
                    }
                });
            });
        });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            $(document).ready(function() {
            $.ajax({
                url: '/api/available-locations',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                var optionsHtml = '';
                $.each(response, function(index, location) {
                    optionsHtml += '<option value="' + location.locationCode + '">' + location.locationCode + '</option>';
                });
                $('#location').html(optionsHtml);
                }
            });
            });
    </script> --}}
@endsection