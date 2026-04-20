# Print Button

Adds a print-friendly button to every post. Clicking it calls `window.print()`. The plugin also injects a `<style media="print">` block that hides navigation, sidebars, and UI chrome - so the printed page contains only the article content.

**Features:**
- Print button in the post meta row (alongside date, reading time, etc.)
- Print stylesheet hides: `header`, `footer`, `nav`, `aside`, the read progress bar, TOC sidebar, and all widget areas
- Appends the URL in parentheses after links (standard print convention), except for anchor and `javascript:` links
- No admin configuration, no database queries

---

## Requirements

- Contensio 2.0 or later

---

## Installation

### Composer

```bash
composer require contensio/plugin-print
```

### Manual

Copy the plugin directory and register the service provider via the admin plugin manager.

No migrations or configuration required.

---

## How it works

The plugin registers two hooks:

**`contensio/frontend/head` (priority 10)**
Injects a `<style media="print">` block. The browser only applies these rules when the page is being printed - no effect on normal rendering.

**`contensio/frontend/post-meta` (priority 20)**
Injects the Print button into the post meta row. Priority 20 places it after reading time (priority 5) and word count (priority 6), near the end of the meta row.

---

## Print stylesheet rules

| Selector | Effect |
|----------|--------|
| `header, footer, nav, aside` | Hidden |
| `#contensio-progress` | Read progress bar hidden |
| `.contensio-toc` | Table of contents hidden |
| `[class*="contensio-widget"]` | All widget areas hidden |
| `.contensio-post-body` | Full width (`max-width: 100%`) |
| `a[href]::after` | URL appended after link text |
| `a[href^="#"]::after` | Anchor links excluded from URL append |

---

## Hook reference

| Hook | Priority | Description |
|------|----------|-------------|
| `contensio/frontend/head` | 10 | Injects print stylesheet |
| `contensio/frontend/post-meta` | 20 | Injects Print button |
