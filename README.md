# WeatherApp

View the full app at [projectjuicebox](http://weather.projectjuicebox.com)

###File list
* _index.php_ - the homepage (contains form for searching by zip/city, and button for searching by GEOIP).
* _display.php_ - displays the weather result with map. Also parses the index.php request.
* _refine-search.php_ - if the city query brings back multiple results, this page displays the selection. Also contains unused lat/lon distance function.
* _city.php_ - displays the result of a refined city search (when multiple cities are reduced to one)
* _APICall.php_ - holds the code for calling the API
* _city.list.json_ - a list of 29,000 cities from [OpenWeatherMap](http://openweathermap.org)

###Improvements
* Merge city.php and display.php. The code is redundant (refine-search could redirect back to display.php)
* Implement geo ip distance function. When you have multiple results, the closest should appear first and be highlited. 
* Add international postal code search (although OpenWeatherMap doesn't store this data)
* Use a mapping api to get US state data based on Lat and Long. OpenWeatherMap does not store states. eg: Search 'Baltimore' returns multiple 'Baltimore, US'.
