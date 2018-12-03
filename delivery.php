<!--==============================content================================--><div class="ic">More Website Templates @ TemplateMonster.com - January 23, 2012!</div>
<div class="main">
    <div class="wrapper">
        <article class="col-1">
            <div class="indent-left">
                <div class="p2">
                    <h3 class="p1">Standard Shipping Rates</h3>
                    <dl class="list-2">
                        <dt><em>Order</em><span>Rate</span></dt>
                        <dd><em>Duis autem vel eum iriure dolor</em><span>$12.95</span></dd>
                        <dd><em>Hendrerit in vulputate velit</em><span>$15.50</span></dd>
                        <dd><em>Esse molestie consequatvel</em><span>$9.95</span></dd>
                        <dd><em>Illum dolore eu feugiat</em><span>$19.25</span></dd>
                        <dd><em>Nulla facilisis at vero eros et </em><span>$12.95</span></dd>
                        <dd><em>Accumsan et iusto odio dignissim</em><span>$15.50</span></dd>
                        <dd><em>Qui blandit praesent luptatum</em><span>$9.95</span></dd>                     
                    </dl>
                </div>
                <h3 class="p1">Standard Delivery Schedule</h3>
                <dl class="list-2">
                    <dt><em>Order placed</em><span>Order received</span></dt>
                    <dd><em>Monday</em><span>Thursday</span></dd>
                    <dd><em>Tuesday</em><span>Friday</span></dd>
                    <dd><em>Wednesday</em><span>Saturday</span></dd>
                    <dd><em>Thursday</em><span>Sunday</span></dd>
                    <dd><em>Friday</em><span>Monday</span></dd>
                    <dd><em>Saturday</em><span>Tuesday</span></dd>
                    <dd><em>Sunday</em><span>Wednesday</span></dd>                     
                </dl>
            </div>
        </article>
        <article class="col-2">
            <h3 class="p1">Shipping In</h3>
            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
            <!--The div element for the map -->
            <div id="map"></div>
            <script>
                // Initialize and add the map
                function initMap() {
                    // The location of Uluru
                    var uluru = {lat: -25.344, lng: 131.036};
                    // The map, centered at Uluru
                    var map = new google.maps.Map(
                            document.getElementById('map'), {zoom: 4, center: uluru});
                    // The marker, positioned at Uluru
                    var marker = new google.maps.Marker({position: uluru, map: map});
                }
            </script>
            <!--Load the API from the specified URL
            * The async attribute allows the browser to render the page while the API loads
            * The key parameter will contain your own API key (which is not needed for this tutorial)
            * The callback parameter executes the initMap() function
            -->
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFTkfTmhOKBxOvXqiMRl_pGa-sQ4M5EkI&callback=initMap">
            </script>
            <h3>Last Minute Gift Ideas</h3>
            <h6 class="p2">Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt magna aliquyam eratsed diam voluptua vero eos et accusam et justo duo dolores et ea rebum.</h6>
            Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est.
        </article>
    </div>
</div>