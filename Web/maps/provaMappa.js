L.mapbox.accessToken =
  "pk.eyJ1Ijoic3Rld2FzaGVzIiwiYSI6ImNqc2h4eWpjdzFoNmI0M3Fnc2ExdHQ2NngifQ.VJFOv11M9x4wxlpxs2vfrQ";
var map = L.mapbox
  .map("map", "mapbox.streets")
  .setView([44.40305, 8.958388], 13);

L.marker([44.40305, 8.958388]).bindPopup('Assistenza Genova Albaro').addTo(map);

L.marker([44.393003, 8.975186]).bindPopup('Assistenza Genova Sturla').addTo(map);

L.marker([44.383941, 9.02389]).bindPopup('Assistenza Genova Quinto-Nervi').addTo(map);

