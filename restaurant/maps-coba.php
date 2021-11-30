
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="google-site-verification" content="vZm0ZMT-vb8aUejnNpsfLSZLYrizCqzwdIISmcwN9Y4" />

    <link rel="icon" type="image/png" href="/favicon.png" />

<link rel="icon" sizes="192x192" href="https://www.latlong.net/icon.png" />
<link rel="apple-touch-icon" href="https://www.latlong.net/apple-touch-icon-152x152.png" sizes="152x152" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159581532-5"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-159581532-5');
</script>

<meta name="description" content="A handy tool to get lat long from address, helps you to convert address to coordinates (latitude longitude) on map, also calculates the gps coordinates." />
<link rel="canonical" href="https://www.latlong.net/convert-address-to-lat-long.html" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"
  integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
  crossorigin=""/>

<div class="form-group col-lg-9">
    <div class="mb-3 ">
        <label class="form-label">Full Address</label>
        <textarea class="form-control span12" rows="5" name="address" id="address" onchange="getCoordinates()"
        placeholder="Enter your restaurant address" value="<?php echo $address; ?>" ></textarea>
    </div>
</div>
<div class="form-group col-lg-3">
    <div class="mb-3">
        <label class="form-label" for="lat">Latitude</label>
        <input clas="form-control form-control-lg" type="text" name="lat" id="lat" placeholder="lat coordinate" />
    </div>

    <div class="mb-3">
        <label class="form-label" for="lng">Longitude</label>
        <input class="form-control form-control-lg" type="text" name="lng" id="lng" placeholder="long coordinate" />
    </div>
</div>

<div id="latlongmap" style="width:100%;height:400px;" class="shadow"></div>


<!-- OneTrust Cookies Consent Notice end for www.latlong.net --><script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"
  crossorigin="">
</script>

<script type="text/javascript">
    
var mymap = L.map('latlongmap');
var mmr = L.marker([0,0]);
mmr.bindPopup('0,0');
mmr.addTo(mymap);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar',
attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mymap);
sm(-7.913402,113.822800,16);
mymap.on('click', onMapClick);

if (frmplace.attachEvent) {
frmplace.attachEvent("submit", getp);
} else {
frmplace.addEventListener("submit", getp);
}

function onMapClick(e) {
mmr.setLatLng(e.latlng);
setui(e.latlng.lat,e.latlng.lng,mymap.getZoom());
}


function sm(lt,ln,zm) {
    setui(lt,ln,zm);
    mmr.setLatLng(L.latLng(lt,ln));
    mymap.setView([lt,ln], zm);
}

function setui(lt,ln,zm) {
    lt = Number(lt).toFixed(6);
    ln = Number(ln).toFixed(6);
document.getElementById("lat").value=lt;
document.getElementById("lng").value=ln;
}
</script>
