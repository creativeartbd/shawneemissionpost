#Project Name


#Must Read
The project should have  a page named `components` and you must make a file in the components
directory first so everybody in our team know there is a component already built.

* Make a general category page if any category layout is different then make a page `category-$slug.php` and use that page
* For any custom query use `get_posts()` instead of `wp_query` class
* All featured image should have a wrapper div and set height width of that according to the design and load appropriate image size



#Image sizes
```
add_image_size( "img-large-size", 1200, 600, true );
add_image_size( "grid-thumbnail", 600, 450, true );
add_image_size( "list-thumbnail", 275, 205, true );
```
#Modules
* Infinite Scroll
* Load More


