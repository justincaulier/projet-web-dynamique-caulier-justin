<div class="map-control" style="width:600px;height:600px">

    <x-maps-leaflet
        :centerPoint="[
        'lat' => $lat,
        'long' => $lon
    ]"
        :zoomLevel="15"
        :markers="[
        ['lat' => $lat, 'long' => $lon]
    ]"
    />

</div>
