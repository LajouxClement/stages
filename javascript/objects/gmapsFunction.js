/**
 * Created by Clément on 28/01/2016.
 */
var map = new GMaps({
    el: '#googleMap',
    lat: 49.1193089,
    lng: 6.1757156,
    scrollwheel: false
});

map.addMarker({
    lat: 49.1193089,
    lng: 6.1757156,
    title: 'Metz',
    infoWindow: {
        content: '<p>Ville de Metz</p>'
    },
    click: function (e) {
        map.setCenter({
            lat: 49.1193089,
            lng: 6.1757156
        });
    }
});

map.addMarker({
    lat: 49.1200532,
    lng: 6.1650726,
    title: 'Metz',
    infoWindow: {
        content: '<p>IUT</p>'
    },
    click: function (e) {
        map.setCenter({
            lat: 49.1200532,
            lng: 6.1650726
        });
    }
});

function mapcentre() {
    map.setCenter({
        lat: 49.1193089,
        lng: 6.1757156
    });

    var path = [[49.1191404, 6.1529705], [49.1214997, 6.1594936], [49.1221737, 6.1661026], [49.1203200, 6.1664459], [49.1189718, 6.1691925], [49.1178483, 6.1667034], [49.1190280, 6.1628410], [49.1181854, 6.1568328]];

    polygon = map.drawPolygon({
        paths: path, // pre-defined polygon shape
        strokeColor: '#BBD8E9',
        strokeOpacity: 1,
        strokeWeight: 3,
        fillColor: '#BBD8E9',
        fillOpacity: 0.6
    });
}