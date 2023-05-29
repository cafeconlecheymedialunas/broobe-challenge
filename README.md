# Broobe Challenge Theme

### Problemas
No pude instalar el Docker Desktop en mi computadora. Por lo tanto no use el wp-env como entorno. Estoy de viaje y hice la prueba con una computadora prestada. El error que me da es que tengo que activar la virtualización. No me dió el tiempo para resolverlo. Use un Laragon 
. Coloco aqui el archivo que hubiese usado pero no pude probarlo

```php
<?php
  {
  "core": "WordPress/WordPress#master",
  "themes" :{
    "https://downloads.wordpress.org/theme/generatepress.3.3.0.zip"
    "cafeconlecheymedialunas/broobe-challenge#master",
  }
  "port": 1000,
  "testsPort": 1001,
  "config": {
    "WP_DEBUG": true,
    "WP_DEBUG_DISPLAY": false,
    "WP_DEBUG_LOG": true
  }

};
?>
```

### Como probar las funcionalidades
- General: 
    En el directorio del theme hay un archivo xml que se puede importar para tener contenido  de prueba. Se debe ir a Herramientas - Importar - Ejecutar el importador. Esto es Opcional
- Metabox Redirect:
    Crear una pagina y se observará el metabox a la derecha
- Listado de Post con paginación:
    Se debe crear o editar una página y pegar en el editor el siguiente shortcode [broobe-postlist]
- Search Filters:
    Buscar desde la sidebar que esta en la home
    O con el parametro al final de la url ?s=Hola


### Mejoras: 
Metabox Redirect:
- Cuando en la cadena de redirecciones se repite alguna de las paginas seleccionadas esto produce un error too many redirects. Hay que validar que las paginas seleccionadas no se repitan y que no superen un cierto numero de redirecciones. Desde el frontend yo pondria en la UI un aviso de que no se puede seleccionar la pagina y el motivo
