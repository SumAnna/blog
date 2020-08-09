<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
    
<xsl:output method="html"/>

<xsl:template match="post">
    <html>
        <head>
            <title>Мини-блог</title>
             <link rel="stylesheet" href="style.css" />
             <script src="form_submit.js"></script>
        </head>
        <body>
            <h1 class="text-center">Мини-блог</h1>
            <div class="container">
                <div class="post">
                    <br/>
                    <div class="post-image"></div>
                    <div class="post-content">
                        <div class="post-title">
                            <a href="/post.php?id={@id}"><xsl:value-of select="@title" /></a>
                        </div>       
                            <p class="post-text">
                                <xsl:value-of select="@content" />
                            </p>
                        <div class="post-footer">
                            <p>Опубликовано: </p>
                            <xsl:value-of select="@created_at" />
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <xsl:for-each select="comment">
                        <div class="comment-container">
                            <br/>
                            <div class="comment-image"></div>
                            <div class="comment-content">
                                <div class="comment-title">
                                    <xsl:value-of select="@author" />
                                </div>       
                                    <p class="comment-text">
                                        <xsl:value-of select="@comment" />
                                    </p>
                                <div class="comment-footer">
                                    <p>Опубликовано: </p>
                                    <xsl:value-of select="@created_at" />
                                </div>
                            </div>
                        </div>
                    </xsl:for-each>
                </div>
                <form method="POST" id="form-comment">
                    <label for="author">Имечко</label>
                    <input type="text" name="author" id="author" placeholder="Введите окурадно имечко"/>
                    <label for="author">Комментик</label>
                    <textarea name="comment" id="comment" placeholder="Введите окурадно комментик">
                    </textarea>
                    <input type="hidden" name="post_id" value="{@id}"/>
                    <button type="submit">Отправлюнькать</button>
                </form>
            </div>
        </body>
    </html>
</xsl:template>



</xsl:stylesheet>