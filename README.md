# API = Aplication Programming Interface

Es un conjunto de reglas que establecen cómo 2 aplicaciones interactuarán entre sí.

## HTTP

Protocolo de comunicación entre aplicaciones.
Basado en el intercabio de texto.
Cómo funciona:

1. Petición de PC a Internet.
2. Petición de Internet a Servidor.
3. Respuesta de Servidor a Internet.
4. Respuesta de Internet a PC.

## Petición HTTP en terminal

`curl https://platzi.com`

## Sólo encabezados

`curl https://platzi.com`

## Redirección de salida

`curl https://platzi.com -v > /dev/null`

## Rest

Estilo de arquitectura de software enfocado en el *intercambio de recursos* y basado en *HTTP*.

## API RESTful

Una API diseñada alrededor de los conceptos de *REST*.

## Conceptos REST

- Recurso
- URI (Universal Resource Identifiers)
- Acción

## Petición REST

- URL
- Verbo HTTP

## Ejemplos REST

- GET/books/1
- DELETE/books/50

## ¿Cuando conviene REST?

- Interacciones simples
- Recursos limitados

## Verbos HTTP

- GET
- POST
- PUT
- DELETE

## Autenticación HTTP

- Poco segura: Las credenciales se envían en cada request

- Ineficiente: La autenticación se realiza en cada request

## HMAC

Más segura. La información que se envía no es muy sensible.

## Access Tokens

Extremadamente segura. Utilizada para casos de información muy sensible.

## Buenas práticas REST

- Recursos = sustantivos
- Plurales
- Modificaciones con POST, PUT, DELETE
- Relaciones = subrecursos
- Navegabilidad vía vínculos
- Colecciones filtrables, ordenables y paginables
- APIs versionadas# CursoAPIREST
