# Mini API en PHP 

Pequeño Script para crear una API sencilla con rutas estructuradas con RegExp

## Configuración

### CORS

En caso de necesitar que la API pueda ser leída por dispositivos externos debemos activar el **Cross Origin Resource Sharing** con la función:

```php
Api::cors();
```

---

### MOD_REWRITE

> Si utiliza **.htaccess** recuerde editar RewriteBase y el ultimo RewriteRule para que sea compatible con el subdirectorio

En caso de utilizar `.htaccess` debemos indicar el parametro **`mod_rewrite`** como **`TRUE`**

```php
Api::cfg('mod_rewrite', true);
```

Eso nos dejara una URL como esta:

```
dominio.com/api/item/5
```

---

En caso de no utilizar `.htaccess` debemos indicar el parametro **`mod_rewrite`** como **`FALSE`**

```php
Api::cfg('mod_rewrite', false);
```

Eso nos dejara una URL como esta:

```
dominio.com/api/index.php/item/5
```

---

## Uso

Para indicar la ruta del inicio debemos dejar vacío el primer parámetro de `Api::ruta()`

El segundo parámetro corresponde a un callback, por lo cual puede ser utilizado con una función guardada en una variable o de manera anónima.

```php
Api::ruta('', function() {
	echo json_encode(['status'=>'ok']);
});
```

---

Para crear una "sección" y obtener valores de ella solo debemos utilizar expresiones regulares

```php
Api::ruta('item/(\d+)', function($id) {
	$Datos = [
		'auth' => 'ok',
		'item' => $id
	];
	echo json_encode($Datos);
});
```

---

Una vez listo nuestro código ejecutamos la API

```php
Api::exe();
```
