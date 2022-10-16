<?php
    require_once 'connection.php';
    class MapFunc{
        private $desc;
        private $latitude = 0.00;
        private $longitude = 0.00;
        private $pass = 0;

        public function ShowMarkers(){
        $success = mysqli_connect('localhost', 'root', '','leafletmap');
		$result = mysqli_query($success, "SELECT * FROM markers_var");
        $rows = mysqli_num_rows($result);
        $this->desc = "";
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $field => $value) { 
                if ($this->pass == 0) {
                    $this->desc = $value;
                }
                elseif ($this->pass == 1) {
                    $this->latitude = $value;
                }
                elseif ($this->pass == 2) {
                    $this->longitude = $value;
                }
                $this->pass += 1;
            }
            echo ("<p>" . $this->latitude . "</p>");
            echo ("<p>" . $this->longitude . "</p>");
            echo ("<p>" . $this->desc . "</p>");
            echo ("<script>
                marker = L.marker ([". json_encode($this->latitude,JSON_PRESERVE_ZERO_FRACTION) . "," . json_encode($this->longitude,JSON_PRESERVE_ZERO_FRACTION) . "]).bindPopup(" . $this->desc . ")
                .addTo(map);
                marker.on('mouseover',function(ev) {
                ev.target.openPopup();
                });
                </script>");
            $this->pass = 0;





            /* echo "<script>
                markers.push(valueset);
                for (var i =0; i < markers.length;i++) {
                    marker = L.marker ([markers[i][1], markers[i][2]]).bindPopup(markers[i][0])
                    .addTo(map);
                    marker.on('mouseover',function(ev) {
                    ev.target.openPopup();
                    });
                }
                </script>"; */
        }
	}
}
?>