<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
    
<xsl:output method="html"/>

<xsl:template match="blog">
    <html>
        <head>
            <title>Мини-блог</title>
             <link rel="stylesheet" href="style.css" />
        </head>
        <body>
            <h1 class="text-center">Мини-блог</h1>
            <div class="container">
                    <xsl:if test="@page &gt; 1" >
                        <a href="/?page={@page - 1}">На страницу меньше</a>
                    </xsl:if> 
                    <xsl:if test="@page &lt; @pages_count" >
                        <a href="/?page={@page + 1}">На страницу больше</a>
                    </xsl:if> 
                <div class="cards">
                    <xsl:for-each select="post">
                        <div class="card">
                            <br/>
                            <div class="card__image"></div>
                            <div class="card__content">
                                <div class="card__title">
                                    <a href="/post.php?id={@id}"><xsl:value-of select="@title" /></a>
                                </div>       
                                    <p class="card__text">
                                        <xsl:value-of select="@content" />
                                    </p>
                                <div class="card__footer">
                                    <xsl:text>Опубликовано: </xsl:text>
                                    <xsl:value-of select="@created_at" />
                                </div>
                                <div class="card__footer">
                                    <xsl:text>Комментариев: </xsl:text>
                                    <xsl:value-of select="@comments" />
                                </div>
                            </div>
                        </div>
                    </xsl:for-each>
                </div>
                    <xsl:if test="@page &gt; 1" >
                        <a href="/?page={@page - 1}">На страницу меньше</a>
                    </xsl:if> 
                    <xsl:if test="@page &lt; @pages_count" >
                        <a href="/?page={@page + 1}">На страницу больше</a>
                    </xsl:if> 
            </div>
        </body>
    </html>
</xsl:template>



</xsl:stylesheet>