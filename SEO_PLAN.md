# SEO Local Automático — Plan de Implementación

> Estado: **Pendiente**. Implementar cuando el producto esté maduro y la estructura de URLs sea estable.

---

## Objetivo

Que cada web generada por Vibly esté optimizada para SEO desde el primer día, sin que el usuario tenga que saber nada de SEO. Cada pieza de contenido (textos, imágenes, servicios, blog) debe ser indexable y encontrable en Google de forma automática.

---

## Prerequisito: campo `city`

Antes de implementar cualquier capa de SEO, añadir un campo `city` explícito en el onboarding y en la sección de contacto del builder. No parsear la dirección libre.

**Onboarding:** nuevo campo opcional "Ciudad" → se guarda en `site.config['city']`
**Contacto (builder):** campo `city` independiente del `address`

El título SEO se construye como:
```
{business_name} · {sector_label} en {city}
Ej: "Barbería Don Carlos · Barbería en Madrid"
```

---

## Capa 1 — Meta tags globales

**Dónde:** en cada `site.blade.php` de todos los themes, dentro del `<head>`.
**Datos de origen:** `$site->config['business_name']`, `$site->config['city']`, sección `contact`, sección `hero`.

```html
<!-- SEO básico -->
<title>{business_name} · {sector_label} en {city}</title>
<meta name="description" content="{subheadline del hero o texto del about, truncado a 155 chars}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://{dominio}/site/{slug}">

<!-- Open Graph (WhatsApp, Facebook, LinkedIn, iMessage) -->
<meta property="og:type"        content="business.business">
<meta property="og:title"       content="{business_name}">
<meta property="og:description" content="{description}">
<meta property="og:image"       content="{logo o primera imagen del hero}">
<meta property="og:url"         content="https://{dominio}/site/{slug}">
<meta property="og:locale"      content="es_ES">

<!-- Twitter Card -->
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{business_name}">
<meta name="twitter:description" content="{description}">
<meta name="twitter:image"       content="{logo o hero image}">
```

**Implementación:** crear un partial `_seo_meta.blade.php` por theme (o uno global en `themes/shared/`) que reciba `$site` y `$sections` y genere todos los tags.

---

## Capa 2 — Schema markup JSON-LD

Google lee esto para mostrar información enriquecida en resultados: horario, teléfono, valoraciones, precio.

### Mapa sector → Schema type

| Sector (template_key) | Schema @type |
|----------------------|--------------|
| `barbershop`         | `HairSalon` |
| `food`               | `Restaurant` o `CafeOrCoffeeShop` |
| `services_local`     | `HomeAndConstructionBusiness` / `Electrician` / `Plumber` |
| `clothing`           | `ClothingStore` |
| Genérico             | `LocalBusiness` |

Este mapa se define en `config/seo.php` como `sector_schema_type`.

### Estructura JSON-LD base

```json
{
  "@context": "https://schema.org",
  "@type": "{schema_type}",
  "name": "{business_name}",
  "url": "https://{dominio}/site/{slug}",
  "telephone": "{contact.phone}",
  "email": "{contact.email}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{contact.address}",
    "addressLocality": "{city}",
    "addressCountry": "ES"
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
      "opens": "09:00",
      "closes": "18:00"
    }
  ],
  "hasMap": "https://maps.google.com/?q={business_name}+{city}",
  "image": "{logo_url o hero image}",
  "priceRange": "€€"
}
```

El `openingHoursSpecification` se genera parseando el campo `contact.hours` (texto libre → estructura). Si no se puede parsear, se omite.

### Schema adicional por sección

**Servicios / Menú / Productos** → `ItemList` + `Offer`:
```json
{
  "@type": "ItemList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "item": {
        "@type": "Service",
        "name": "Corte clásico",
        "description": "Corte tradicional con acabado perfecto",
        "offers": { "@type": "Offer", "price": "15", "priceCurrency": "EUR" }
      }
    }
  ]
}
```

**Reseñas** → `AggregateRating` (Google muestra las estrellitas en resultados):
```json
{
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "12"
  }
}
```

**Blog posts** → `Article` schema en cada post individual.

---

## Capa 3 — Imágenes optimizadas automáticamente

Aplicar en el momento de subida (`BuilderController::uploadImage` y `CatalogController::uploadDefaultImage`):

1. **Renombrar el archivo** antes de guardar:
   ```
   {slug-negocio}-{tipo-seccion}-{timestamp}.jpg
   Ej: barberia-don-carlos-galeria-1743500000.jpg
   ```

2. **Alt text automático** en todas las imágenes del theme:
   ```html
   <!-- Hero -->
   <img alt="{business_name} · {sector_label} en {city}">

   <!-- Servicio -->
   <img alt="{nombre_servicio} · {business_name}">

   <!-- Galería -->
   <img alt="{caption si existe} · {business_name} · {city}">

   <!-- Team -->
   <img alt="{nombre} · {role} en {business_name}">
   ```

3. **Dimensiones explícitas** (`width` y `height`) en todas las imágenes para evitar Cumulative Layout Shift (CLS), que penaliza en Core Web Vitals.

---

## Capa 4 — Sitemap dinámico

Nueva ruta pública: `GET /site/{slug}/sitemap.xml`

Generado dinámicamente con:
- Página principal
- Página de servicios/menú/productos (si tiene `show_more`)
- Página de galería (si tiene `show_more`)
- Posts de blog publicados (con `lastmod` = `updated_at`)

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://{dominio}/site/{slug}</loc>
    <lastmod>{site.updated_at}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://{dominio}/site/{slug}/p/services</loc>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://{dominio}/site/{slug}/blog/mi-post</loc>
    <lastmod>{post.updated_at}</lastmod>
    <priority>0.6</priority>
  </url>
</urlset>
```

---

## Capa 5 — Indexación al publicar

Cuando el usuario pulsa "Publicar" en el builder (`BuilderController::publish`), hacer ping a Google:

```php
// Notificar a Google del sitemap
Http::get('https://www.google.com/ping', [
    'sitemap' => route('site.sitemap', $site->slug)
]);
```

Solo ejecutar si el site tiene dominio verificado o está en producción. Envolver en `try/catch` — si falla, no bloquear la publicación.

---

## Archivos a crear / modificar

| Archivo | Acción |
|---------|--------|
| `config/seo.php` | Nuevo — mapa sector→schema type, configuración global |
| `app/Services/SeoService.php` | Nuevo — genera meta tags, JSON-LD, alt texts |
| `resources/views/themes/shared/_seo_meta.blade.php` | Nuevo — partial de meta tags (compartido entre themes) |
| `resources/views/themes/shared/_schema_jsonld.blade.php` | Nuevo — partial JSON-LD |
| `app/Http/Controllers/SitemapController.php` | Nuevo |
| `routes/web.php` | Añadir ruta sitemap |
| `app/Http/Controllers/BuilderController.php` | Modificar `publish()` para ping + renombrar imágenes en `uploadImage()` |
| Todos los `site.blade.php` de cada theme | Incluir `_seo_meta` y `_schema_jsonld` |
| Onboarding — migración + vista | Añadir campo `city` |
| `config/catalog.php` + `catalog_sectors` DB | Añadir campo `schema_type` por sector |

---

## Orden de implementación

1. Campo `city` en onboarding + contacto (prerequisito de todo lo demás)
2. `config/seo.php` + `SeoService`
3. Meta tags + Open Graph (Capa 1)
4. Schema JSON-LD base por sector (Capa 2)
5. Schema de reseñas `AggregateRating`
6. Alt texts automáticos en imágenes (Capa 3)
7. Sitemap dinámico (Capa 4)
8. Schema de servicios `ItemList`
9. Schema de blog `Article`
10. Ping a Google al publicar (Capa 5)

---

## Notas adicionales

- **Dominios personalizados:** el canonical y las URLs del sitemap deben usar el dominio propio del site si `domain_verified = true`, no el dominio de Vibly.
- **Google Business Profile:** no hay API pública para crearlo automáticamente. Añadir un botón en el dashboard que lleve al formulario de Google pre-rellenado con los datos del site.
- **Core Web Vitals:** además del SEO de contenido, Google penaliza sitios lentos. Revisar LCP (Largest Contentful Paint) en los themes — las imágenes hero son el principal cuello de botella. Considerar `loading="lazy"` en imágenes fuera del viewport y `fetchpriority="high"` en el hero.
