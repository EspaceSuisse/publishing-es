# Espace Susisse Publishing Page

Die ES Publishing Page beinhalted Artikel aus Inforaum und Raum & Umwelt.

## Installation

1. Clone dieses Git Repo via https (SSH wird von der ES Firewall geblockt)
2. Starte Docker
3. Terminal > `composer install`
4. Terminal > `ddev start`. Falls ddev nicht installiert ist: https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/ 
5. Lade ein db dump herunter und installiere via: `ddev import-db --file=YOUR_PATH_TO_SQL_DUMP`
6. Rename `.env.example.dev` zu `.env` und fülle die variablen ein
7. Success.

Bei Hilfe:

- Craft CMS Stack Overflow: https://craftcms.stackexchange.com/
- Craft CMS Discord: https://discord.com/invite/uuDFCTX
- Dokumentation: https://craftcms.com/docs/5.x/

## Github
- Es wird niemals im Main Branch gearbeitet sondern nur arbeits branches darin eingechekt.
- Auf der Lokalen Maschine wird ein Working Branch ausgecheckt in welchen dann commited wird.
- Wenn das Minimum Viable Product existiert wird pro feature/bug ein branch erstellt und nach erfolgreichem deploment/testing gelöscht.
- Deployment auf STAGING & LIVE wird via Pull Reuests auf der Github homepage gemacht.

## Craft CMS

### Folder Structure

templates/
│── _layouts/        # Base layouts
│── _partials/       # Reusable partials (headers, footers, etc.)
│── _components/     # UI components (buttons, cards, etc.)
│── _macros/         # Twig macros
│── pages/           # Page-specific templates
│── sections/        # Homepage, blog, shop, etc.
│── index.twig       # Default entry point

### Core Concepts

#### Entries & Sections

Craft organizes content into Entries, which belong to Sections.

- Single: A one-off page (e.g., "About Us").
- Channel: A collection of entries with the same structure (e.g., "Blog Posts").
- Structure: Hierarchical entries (e.g., "Documentation" or "Categories").

📌 Example:
A blog could have a Channel section named "Blog" with multiple entries (posts).

#### Fields & Field Groups

Instead of rigid content types, Craft lets you define your own fields and group them for better organization.

##### Common field types:
- Plain Text (Titles, summaries)
- Rich Text (Redactor) (Formatted content)
- Assets (Images, PDFs)
- Entries (Relationships between content)
- Categories & Tags (Organizing content)
- Lightswitch (On/off toggle)

📌 Example:
A blog post might use:

- A Plain Text field for the title
- A Rich Text field for the content
- An Asset field for the featured image

#####  Matrix Fields (Flexible Content Blocks)

Matrix fields allow for reusable, structured content blocks, perfect for dynamic page layouts.

A Matrix field contains Block Types, each with its own set of fields.

📌 Example:
A Matrix field for a landing page might include:

- Text Block (Title + Rich Text)
- Image Block (Asset field + Caption)
- Quote Block (Plain Text for quote + Author name)

Matrix blocks allow editors to build flexible layouts without needing developers to create new templates every time.

#### Categories & Tags

Categories help organize content hierarchically, while Tags are more flexible.

📌 Example:
A "Blog" section could have categories like:
📂 News → Articles about current events
📂 Tutorials → Step-by-step guides

####  Relations (Entries, Assets, Users)

Craft allows you to relate content together, so an entry can reference:

- Other Entries (e.g., a blog post linking to related posts)
- Users (e.g., assigning an author to a post)
- Assets (e.g., featured images, PDFs)

This makes it easy to create dynamic content relationships across the site.

#### Craft CMS Templating (Twig Basics)

Craft uses Twig for templating, making it easy to pull in content.

📌 Example: Fetching Blog Posts

```
{% set posts = craft.entries.section('blog').limit(5).all() %}
{% for post in posts %}
    <h2><a href="{{ post.url }}">{{ post.title }}</a></h2>
    <p>{{ post.summary }}</p>
{% endfor %}
```
📌 Example: Displaying an Image Field
```
{% set image = entry.featuredImage.one() %}
{% if image %}
    <img src="{{ image.url }}" alt="{{ image.title }}">
{% endif %}
```

🔗 Resources

    📘 Official Craft CMS Documentation
    🛠 Craft CMS GitHub Repo
    💬 Craft Discord Community