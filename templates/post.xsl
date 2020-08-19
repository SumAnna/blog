<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
    
<xsl:output method="html"/>

<xsl:template match="post">
    <html>
        <head>
            <title>Мини-блог</title>
            <link rel="stylesheet" href="/styles/style.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
            <script src="/javascript/form_submit.js"></script>
        </head>
        <body>
            <div class="container">
                <h1 class="text-center comment-leave">Блог</h1>
                <a class="btn-back" href="/">К постам</a>
                <article>
                    <h1><xsl:value-of select="@title" /></h1>
                    <h4><xsl:value-of select="@created_at" /></h4>
                    <p><img class="left" src="/images/default180x180.jpg" /> <xsl:value-of select="@content" disable-output-escaping="yes" /></p>
                </article>
                <h1 class="text-center">Комментарии:</h1>
                <div class="comments">
                    <xsl:for-each select="comment">              
                        <div class="comments-container">
                            <div class="comment-main-level">
                                <div class="comment-avatar"><img src="/images/comment.jpg" alt="comment-img"/></div>
                                    <div class="comment-box">
                                        <div class="comment-head">
                                                <h6 class="comment-author"><xsl:value-of select="@author" /></h6>
                                                <p class="comment-date">Опубликовано: <xsl:value-of select="@created_at" /></p>
                                                <p class="comment-ip"> IP: <xsl:value-of select="@ip" /></p>
                                        </div>
                                        <div class="comment-content">
                                            <xsl:value-of select="@comment" disable-output-escaping="yes" />
                                        </div>
                                    </div>
                            </div> 
                        </div>
                    </xsl:for-each>
                </div>
                <div class="comments-container hidden hidden-comment">
                    <div class="comment-main-level">
                        <div class="comment-avatar">
                            <img src="/images/comment.jpg" alt="comment-{@id}-img"/>
                        </div>
                        <div class="comment-box">
                            <div class="comment-head">
                                    <h6 class="comment-author"></h6>
                                    <p class="comment-date"></p>
                                    <p class="comment-ip"></p>
                            </div>
                            <div class="comment-content"></div>
                        </div>
                    </div>
                </div>
                <div id="comments-form" class="comments-form">
                    <h2 class="comment-leave">Добавить комментарий</h2>    
                    <div class="message-box hidden">
                        <i class="fa-2x"></i><ul id="validation" class="message-text"></ul>
                    </div> 
                    <form method="POST" id="form-comment">
                        <div class="field-wrapper">
                            <label for="author">Имя</label>
                            <input type="text" name="author" id="author"/>
                        </div>
                        <div class="field-wrapper">
                          <label for="comment">Комментарий</label>
                          <textarea name="comment" id="comment"></textarea>
                        </div>
                      <div class="field-wrapper">
                        <input type="hidden" name="post_id" value="{@id}"/>
                        <input class="btn" type="submit" value="Добавить" />
                      </div>  
                    </form>
                </div>
            </div>
        </body>
    </html>
</xsl:template>



</xsl:stylesheet>