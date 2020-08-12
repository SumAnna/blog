<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
    
<xsl:output method="html"/>

<xsl:template match="blog">
    <html>
        <head>
            <title>Мини-блог</title>
             <link rel="stylesheet" href="../styles/style.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        </head>
        <body>
            
            <div class="container">
                <h1 class="text-center comment-leave">Блог</h1>
                <div class="pagination">
                    <xsl:if test="@page &gt; 1" >.
                        <a href="/?page={@page - 1}">
                            <div class="btn-back float-left">
                                Вперед
                            </div>
                        </a>
                    </xsl:if> 
                    <xsl:if test="@page &lt; @pages_count" >
                        <a href="/?page={@page + 1}">
                            <div class="btn-back float-right">
                               Назад
                            </div>
                        </a>
                    </xsl:if>
                </div>     
                <div class="cards">
                    <xsl:for-each select="post">
                        <div class="card">
                            <br/>
                            <div class="card-image"></div>
                            <div class="card-content">
                                <div class="card-title">
                                    <a href="/post.php?id={@id}"><xsl:value-of select="@title" /></a>
                                </div>       
                                    <p class="card-text">
                                        <xsl:value-of select="@content" />
                                    </p>
                                <div class="card-footer">
                                    <xsl:text>Опубликовано: </xsl:text>
                                    <xsl:value-of select="@created_at" />
                                </div>
                                <div class="card-footer">
                                    <xsl:text>Комментариев: </xsl:text>
                                    <xsl:value-of select="@comments" />
                                </div>
                            </div>
                        </div>
                    </xsl:for-each>
                </div>
            </div>
        </body>
    </html>
</xsl:template>



</xsl:stylesheet>