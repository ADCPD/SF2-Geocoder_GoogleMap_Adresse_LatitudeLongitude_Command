Dans le ./App et ./App/Config 

#Routing.yml

geo_codeur_homepage:
    path:     /GeoGoogleBundle
    defaults: { _controller: 'GeoCodeurBundle:Default:index' }


#AppKarnel.php    

...
new GeoCodeurBundle\GeoCodeurBundle(),
...