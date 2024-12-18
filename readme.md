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

## Git Ettiquette
- Es wird niemals im Main Branch gearbeitet sondern nur arbeits branches darin eingechekt.
- Auf der Lokalen Maschine wird ein Working Branch ausgecheckt in welchen dann commited wird.
- Wenn das Minimum Viable Product existiert wird pro feature/bug ein branch erstellt und nach erfolgreichem deploment/testing gelöscht.
- Deployment auf STAGING & LIVE wird via Pull Reuests auf der Github homepage gemacht.

## Basic Concept

### Config

Alle Pfade und variablen werden in die `.env` geschrieben und dann an den entsprechenden Stellen aufgereufen. DIE .ENV DARF NIEMALS INS REPO EINGECHEKCT WERDEN.

Die `.env` variablen werden dann in den config files im Ordner geladen oder können auch im COntrolpanel verwendet werden.

## Templates

Templates werden mit Twig geschrieben. Natives PHP wird nicht verwendet (Und ist standardmässig deaktiviert). https://craftcms.com/docs/getting-started-tutorial/build/twig.html

## Craft Content Architektur:

Im Craft Control Panel können folgende Strukturen gebaut werden:

### Sektionen https://craftcms.com/docs/5.x/reference/element-types/entries.html#sections
Sektionen sind alle Seiten arten vom CMS. z.b:

#### Einzeleintrag
Einzelne Seiten

- Startseite
- Artikel Übersicht
- Kontakt Seite
- About Seite

#### Kanal
Sich wiederholender Content

- Blog Posts
- Artikel

#### Struktur
Sich wiederholender COntent, der aber keine feste Reihenfolge hat.
- Z.b. FAQ

#### Eintragstypen https://craftcms.com/docs/5.x/reference/element-types/entries.html#entry-types

Allen Sektionen können *Eintragstypen* hinzugefügt werden. Das sind verschiedene Feldersets.

- Blog Post mit Eintragstyp Kurz
- Blog Post mit Eintragstyp lang

### Felder https://craftcms.com/docs/5.x/system/fields.html

Es gibt sehr viele Felder die mehrfach allen Sektionen zugewiesen werden können. So kann man ein einzelnes Textfeld sowohl in der Blog Sektion als auch auf der Kontakt Page verwendet werden

#### Matrix Felder https://craftcms.com/docs/5.x/reference/field-types/matrix.html

Matrix Felder sind Content Blöcke, die dem Editor eine Feldauswahl beiten, aus denen extrem Individuelle Artikel geschrieben werden können.

Beispiel:

Eine Artikel Sektion mit einem Matrix Feld, Welches folgende Optionen hat: Textfeld, Bildfeld, Zitat, Textkasten.
Diese Blöcke können dann fix fertig vordesignt werden das alle Artikel konsistent wirken, aber der Editor trotzdem die Wahlmöglichkeit hat (Wenn es bei einem Artikel kein Textkasten braucht, dannw ird auch keiner angezeigt.)

## Kategorien

Alle Artikel werden in den selben Kanälen gehalten und via Kategorien aufgeteilt und dann auf Kategorien pages automatisch zusammen gefasst.
