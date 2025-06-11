<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:media="http://search.yahoo.com/mrss/">

	<xsl:output method="html" encoding="UTF-8" indent="yes"/>

	<xsl:template match="/">
		<html>
			<head>
				<title><xsl:value-of select="rss/channel/title"/></title>
				<style>
					body {
						font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
						margin: 2rem auto;
						padding: 1rem;
						max-width: 800px;
						line-height: 1.6;
						color: #333;
						background-color: #fdfdfd;
					}
					h1 {
						font-size: 1.75rem;
						margin-bottom: 0.5rem;
					}
					.item {
						margin: 2rem 0;
						border-bottom: 1px solid #ccc;
						padding-bottom: 1rem;
					}
					img {
						max-width: 100%;
						height: auto;
						margin: 1rem 0;
					}
					.pubDate {
						color: #666;
						font-size: 0.9rem;
					}
				</style>
			</head>
			<body>
				<h1><xsl:value-of select="rss/channel/title"/></h1>
				<p><xsl:value-of select="rss/channel/description"/></p>

				<xsl:for-each select="rss/channel/item">
					<div class="item">
						<h2>
							<a href="{link}">
								<xsl:value-of select="title"/>
							</a>
						</h2>
						<div class="pubDate">
							<xsl:value-of select="pubDate"/>
						</div>

						<xsl:if test="media:content/@url">
							<img>
								<xsl:attribute name="src">
									<xsl:value-of select="media:content/@url"/>
								</xsl:attribute>
							</img>
						</xsl:if>

						<div class="description">
							<xsl:value-of select="description" disable-output-escaping="yes"/>
						</div>
					</div>
				</xsl:for-each>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
