<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:images="https://kaspar-allenbach.ch/rss/images"
    xmlns:custom="https://kaspar-allenbach.ch/rss/custom"
    exclude-result-prefixes="media images"
>
    <xsl:output
        method="html"
        encoding="UTF-8"
        indent="yes"
    />

    <xsl:template match="/">
        <html>
            <head>
                <title>
                    <xsl:value-of select="rss/channel/title"/>
                </title>

                <meta charset="UTF-8"/>

                <style>
                    body {
                        max-width: 800px;
                        margin: 2rem auto;
                        padding: 1rem;

                        font-family:
                            -apple-system,
                            BlinkMacSystemFont,
                            "Segoe UI",
                            Roboto,
                            Oxygen,
                            Ubuntu,
                            sans-serif;
                        line-height: 1.6;

                        color: #333;
                        background-color: #fdfdfd;
                    }

                    h1 {
                        margin-bottom: 0.5rem;
                        font-size: 1.75rem;
                    }

                    h2 {
                        margin-top: 0;
                    }

                    h2 a {
                        color: inherit;
                        text-decoration: none;
                    }

                    h2 a:hover {
                        text-decoration: underline;
                    }

                    .item {
                        margin: 2rem 0;
                        padding-bottom: 2rem;
                        border-bottom: 1px solid #ccc;
                    }

                    .pubDate {
                        margin-bottom: 1rem;
                        color: #666;
                        font-size: 0.9rem;
                    }

                    .rss-images {
                        display: grid;
                        grid-template-columns: repeat(
                            auto-fit,
                            minmax(220px, 1fr)
                        );
                        gap: 1rem;
                        margin: 1.5rem 0;
                    }

                    .rss-image {
                        min-width: 0;
                        margin: 0;
                    }

                    .rss-image img {
                        display: block;
                        width: 100%;
                        max-width: 100%;
                        height: auto;
                        margin: 0;
                        background-color: #eee;
                    }

                    .rss-image figcaption {
                        margin-top: 0.4rem;
                        color: #666;
                        font-size: 0.8rem;
                    }

                    .description {
                        margin-top: 1rem;
                    }
                </style>
            </head>

            <body>
                <h1>
                    <xsl:value-of select="rss/channel/title"/>
                </h1>

                <p>
                    <xsl:value-of select="rss/channel/description"/>
                </p>

                <xsl:for-each select="rss/channel/item">
                    <xsl:variable
                        name="itemTitle"
                        select="title"
                    />

                    <div class="item">
                        <h2>
                            <a href="{link}">
                                <xsl:value-of select="title"/>
                            </a>
                        </h2>

                        <div class="pubDate">
                            <xsl:value-of select="pubDate"/>
                        </div>

                        <!-- Render all nested Media RSS images. -->
                        <xsl:if test=".//media:content[@url]">
                            <div class="rss-images">
                                <xsl:for-each
                                    select=".//media:content[@url]"
                                >
                                    <figure class="rss-image">
                                        <a href="{@url}">
                                            <img>
                                                <xsl:attribute name="src">
                                                    <xsl:value-of select="@url"/>
                                                </xsl:attribute>

                                                <xsl:attribute name="alt">
                                                    <xsl:value-of
                                                        select="$itemTitle"
                                                    />
                                                </xsl:attribute>

                                                <xsl:if test="@width">
                                                    <xsl:attribute name="width">
                                                        <xsl:value-of
                                                            select="@width"
                                                        />
                                                    </xsl:attribute>
                                                </xsl:if>

                                                <xsl:if test="@height">
                                                    <xsl:attribute name="height">
                                                        <xsl:value-of
                                                            select="@height"
                                                        />
                                                    </xsl:attribute>
                                                </xsl:if>

                                                <xsl:attribute name="loading">
                                                    lazy
                                                </xsl:attribute>
                                            </img>
                                        </a>

                                        <figcaption>
                                            <xsl:value-of
                                                select="local-name(..)"
                                            />

                                            <xsl:if test="@width and @height">
                                                <xsl:text> — </xsl:text>
                                                <xsl:value-of select="@width"/>
                                                <xsl:text> × </xsl:text>
                                                <xsl:value-of select="@height"/>
                                                <xsl:text> px</xsl:text>
                                            </xsl:if>
                                        </figcaption>
                                    </figure>
                                </xsl:for-each>
                            </div>
                        </xsl:if>

                        <div class="description">
                            <xsl:value-of
                                select="description"
                                disable-output-escaping="yes"
                            />
                        </div>
                    </div>
                </xsl:for-each>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>