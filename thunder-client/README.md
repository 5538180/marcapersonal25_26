# Thunder Client - marcapersonal25_26

Importa estos dos archivos desde Thunder Client:

- `thunder-environment_marcapersonal25_26.test.json`
- `thunder-collection_marcapersonal25_26.json`

Selecciona el environment `marcapersonal25_26.test`.

Usa siempre:

```text
http://marcapersonal25_26.test
```

No uses:

```text
https://www.marcapersonal25_26.test
```

Rutas API:

```text
{{base_url}}/api/estudiantes
{{base_url}}/api/proyectos
{{base_url}}/api/familia-profesional
{{base_url}}/api/ciclos-formativos
```

Rutas web Blade:

```text
{{base_url}}/login
{{base_url}}/register
{{base_url}}/estudiantes
```

Para login desde Thunder:

1. Ejecuta `GET sanctum csrf-cookie`.
2. Copia el valor de la cookie `XSRF-TOKEN` al environment como `xsrf_token`.
3. Rellena `email` y `password`.
4. Ejecuta `POST login`.
5. Ejecuta `GET api user`.
