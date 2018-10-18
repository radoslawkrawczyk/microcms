# MicroCMS

This microCMS serves as a REST API Webservice. It has a built-in admin panel, that can be used to make dynamic content separated from the front-end layer. It is written in PHP, using CodeIgniter 3.1.9. It can be used on most free and paid shared hostings.

## Installation
1. Clone or download this repository
2. Put your main index.html file in `application/views/index.html`
3. Upload all the content to your server
4. Go to `http://yourdomain.com/admin` and configure your username and password
5. Integrate your dynamic content with your website


## Admin panel
You can find there a link named *Add Text* leading to a subpage where you can create your own content.
![addtext](https://user-images.githubusercontent.com/38265779/47162423-34884880-d2f4-11e8-969e-56f4c94a62af.png "Image showing adding text")

## How to get resources?
This microCMS allows you to send a `GET` request to endpoint showed in the admin panel. No authorization is required.
### Example request
```
[GET] /api/text/1
```
### Example response
```
{
    "id":"1",
    "text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vehicula, massa at hendrerit sagittis, libero nisi luctus ante, ac imperdiet ante magna in odio. Nam sed tempor felis. Suspendisse non justo vitae leo iaculis sollicitudin eu sit amet nibh. Sed sodales, orci ut blandit efficitur, nisi purus maximus quam, vitae egestas sapien purus eu ipsum. Cras risus eros, egestas tempor purus sed, vehicula euismod sapien. Morbi porttitor leo a efficitur dictum. Suspendisse pulvinar iaculis pharetra. Sed vel ligula purus. Vestibulum rutrum urna sit amet vehicula euismod.",
    "date":"1539873435",
    "desc":"My first text"
}
```
Sending request without ID given `[GET] /api/text/` will show all the resources